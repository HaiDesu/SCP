<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Controller,
	Phalcon\Tag as Tag,
	Phalcon\Db\RawValue as RawValue;
	
use Abstaff\Models\Users as Users,
	Abstaff\Models\SuccessLogins as SuccessLogins,
	Abstaff\Models\FailedLogins as FailedLogins,
	Abstaff\Controllers\Exception as Exception;

class SessionController extends Controller
{

	public function initialize()
    {
        if ($this->session->get('auth')) {
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
	
	public function registerAction()
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
			$user->salt = $this->_generateSalt();
            $user->password = $this->_generatePassHash($password, $user->salt);
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
     * This actions receive the input from the login form
     *
     */
    public function startAction()
    {
        if ($this->request->isPost()) {
            $identity = $this->request->getPost('identity', 'email');
			
			$check = Users::findFirst("email='$identity'");
			if ($check != false) {
				$password = $this->request->getPost('password');
				$password = $this->_generatePassHash($password, $check->salt);
				
				$user = Users::findFirst("email='$identity' AND password='$password'");
				if ($user != false) {
					if ($user->validated == 'Y') {
						$this->_registerSession($user);
						$this->_saveSuccessLogin($user);
						//Using session flash
						$this->flashSession->success('Welcome ' . $user->username);
						//Make a full HTTP redirection
						return $this->response->redirect('index');
					}
					$this->flash->error('Please click the link sent to your email to activate your account');
				}
				$this->_saveFailedLogin($user);
				$this->flash->error('Wrong email/password');
				return $this->dispatcher->forward(array("action" => "index"));
			}
			$this->flash->error('No user found with that username/email');
        }

        return $this->forward('session/index');
    }
	
	/**
     * Register authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession($user)
    {
        $this->session->set('auth', array(
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email
        ));
    }
	
	/**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function logoutAction()
    {
        $this->session->remove('auth');
		$this->flash->success('Session and cookies destroyed. Successfully Signed out.');
        return $this->dispatcher->forward(array("action" => "index"));
    }
	
	/**
	 * Stores a successful login in the db
	 *
	 * @param Abstaff\Models\Users $user
	 */
	private function _saveSuccessLogin($user)
	{
		$successLogin = new SuccessLogins();
		$successLogin->userId = $user->id;
		$successLogin->ipAddress = $this->request->getClientAddress();
		$successLogin->userAgent = $this->request->getUserAgent();
		$successLogin->date = new RawValue('now()');
		if (!$successLogin->save()) {
			$messages = $successLogin->getMessages();
			//throw new Exception($messages[0]);
		}
	}
	
	/**
	 * Stores a failed login attempt in the db
	 *
	 * @param Abstaff\Models\Users $user
	 */
	private function _saveFailedLogin($user)
	{
		$failedLogin = new FailedLogins();
		$failedLogin->userId = $user->id;
		$failedLogin->ipAddress = $this->request->getClientAddress();
		$failedLogin->userAgent = $this->request->getUserAgent();
		$failedLogin->date = new RawValue('now()');
		$failedLogin->attempted = time();
		$failedLogin->save();
		$attempts = FailedLogins::count(array(
			'ipAddress = ?0 AND attempted >= ?1',
			'bind' => array(
				$this->request->getClientAddress(),
				time() - 3600 * 6
			)
		));
		switch ($attempts) {
			case 1:
			case 2:
				// no delay
				break;
			case 3:
			case 4:
				sleep(2);
				break;
			default:
				sleep(4);
				break;
		}
	}
	
	private function _generateSalt()
	{
		return substr(hash('md5', uniqid(mt_rand(), true) . time()), 0, 32);
	}
	
	private function _generatePassHash($passInput, $salt)
	{
		return hash('sha256', $salt.$passInput);
	}

}