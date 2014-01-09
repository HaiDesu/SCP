<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Controller,
	Phalcon\Tag as Tag,
	Phalcon\Db\RawValue as RawValue;
	
use Abstaff\Auth\Exception as AuthException,
	Abstaff\Models\Users as Users,
	Abstaff\Models\SuccessLogins as SuccessLogins,
	Abstaff\Models\FailedLogins as FailedLogins,
	Abstaff\Controllers\Exception as Exception;

class SessionController extends Controller
{

	public function initialize()
    {
        if ($this->session->get('auth-identity')) {
			$this->flashSession->error('Already authenticated!');
			return $this->response->redirect('index');
		}
		$this->view->setTemplateAfter('guest');
        Tag::setTitle('Authenticate Yourself');
    }
	
	public function indexAction()
	{
		//
	}
	
	/**
     * Process data from the login form
     *
     */
	public function startAction()
	{
		try {
		
			if ($this->request->isPost()) {
			
				$this->auth->check(array(
					'email' => $this->request->getPost('identity', 'email'),
					'password' => $this->request->getPost('password'),
					'remember' => $this->request->getPost('remember')
				));
				return $this->response->redirect('index');
			
			} else {
			
				if ($this->auth->hasRememberMe()) {
					return $this->auth->loginWithRememberMe();
				}
				return $this->response->redirect('index');
			
			}
			
		} catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }
	}
	
	public function createAction()
	{
	
		$request = $this->request;
        if ($request->isPost()) {

            $username = $request->getPost('username', 'alphanum');
            $email = $request->getPost('email', 'email');
            $password = $request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');

            if ($password != $repeatPassword) {
                $this->flash->error('Passwords do not match!');
                return false;
            }

            $user = new Users();
            $user->username = $username;
			$user->email = $email;
            $user->password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 11]);
            $user->regDate = new RawValue('now()');
            $user->validated = 'N';
			$user->banned = 'N';
            $user->group = 3;
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                Tag::setDefault('email', '');
                Tag::setDefault('password', '');
                $this->flash->success('Sign Up was successful! Please check your email to confirm your account.');
                return $this->dispatcher->forward(array("action" => "index"));
            }
        }
	
	}
	
	
	/**
     * Presents password forget form
     */
    public function forgotPasswordAction()
    {
        if ($this->request->isPost()) {
		
			$user = Users::findFirstByEmail($this->request->getPost('email'));
			if (!$user) {
				$this->flash->success('There is no account associated with this email');
			} else {

				$resetPassword = new ResetPasswords();
				$resetPassword->userId = $user->id;
				if ($resetPassword->save()) {
					$this->flash->success('Success! Please check your messages for an email reset password');
				} else {
					foreach ($resetPassword->getMessages() as $message) {
						$this->flash->error($message);
					}
				}
			}
		
		}
    }
	
	/**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();
        return $this->response->redirect('index');
    }

}