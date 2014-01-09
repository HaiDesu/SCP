<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
	Phalcon\Db\RawValue as RawValue,
    Phalcon\Paginator\Adapter\Model as Paginator,
	Phalcon\Tag as Tag;
	
use Abstaff\Models\Users as Users,
	Abstaff\Models\UserGroups as UserGroups,
	Abstaff\Models\SuccessLogins as SuccessLogins;

class UsersController extends ControllerBase
{

	public function indexAction()
	{
		$users = Users::find();
		$this->view->setVar("users", $users);
	}
	
	/**
     * Displays the detailed user info based on $id
	 *
	 * @param string $id
     */
	public function showAction($id)
	{
		$user = Users::findFirstByid($id);
		if (!$user) {
			$this->flash->error("user was not found");
			return $this->dispatcher->forward(array(
				"controller" => "users",
				"action" => "index"
			));
		}
		$user->group = UserGroups::findFirstByid($user->group);
		$successlogins = SuccessLogins::find(array(
			'userId = ?0', 'bind' => array($user->id)
		));
		$this->view->setVar("user", $user);
		$this->view->setVar("successlogins", $successlogins);
	}
	
	/**
     * Displays the create form
     */
	public function newAction()
	{
		//
	}
	
	/**
     * Saves data from new user form
     */
	public function createAction()
	{
		$request = $this->request;
        if ($request->isPost()) {

            $username = $request->getPost('username', 'alphanum');
            $email = $request->getPost('email', 'email');
            $password = $request->getPost('password');
            $group = $this->request->getPost('group');

            $user = new Users();
            $user->username = $username;
			$user->email = $email;
            $user->password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 11]);
            $user->regDate = new RawValue('now()');
            $user->validated = 'Y';
            $user->banned = 'N';
            $user->group = $group;
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
					return $this->dispatcher->forward(array("action" => "new"));
                }
            } else {
                Tag::setDefault('email', '');
                Tag::setDefault('password', '');
                $this->flash->success('Account created successfully');
                return $this->dispatcher->forward(array("action" => "index"));
            }
        }
		return $this->forward('users/index');
	}
	
	/**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $user = Users::findFirstByid($id);
            if (!$user) {
                $this->flash->error("user was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "users",
                    "action" => "index"
                ));
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("username", $user->username);
            $this->tag->setDefault("email", $user->email);
            $this->tag->setDefault("validated", $user->validated);
            $this->tag->setDefault("banned", $user->banned);
            $this->tag->setDefault("group", $user->group);
            
        }
    }
	
	 /**
     * Saves an edited user
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $user = Users::findFirstByid($id);
        if (!$user) {
            $this->flash->error("user does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $user->id = $this->request->getPost("id");        
        $user->username = $this->request->getPost("username");        
        $user->email = $this->request->getPost("email");        
        $user->validated = $this->request->getPost("validated");        
        $user->banned = $this->request->getPost("banned");        
        $user->group = $this->request->getPost("group");        

        if (!$user->save()) {

            foreach ($page->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "edit",
                "params" => array($page->id)
            ));
        }

        $this->flash->success("user was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "users",
            "action" => "index"
        ));

    }
	
	/**
     * generates an md5 hash to be used as a salt
     */
	private function _generateSalt()
	{
		return substr(hash('md5', uniqid(mt_rand(), true) . time()), 0, 32);
	}
	
	/**
     * generates a sha-256 hash to be stored in database
	 *
	 * @param string $salt
	 * @param string $passInput
	 * return string
     */
	private function _generatePassHash($passInput)
	{
		//return hash('sha256', $salt.$passInput);
		return password_hash($passInput, PASSWORD_DEFAULT, ["cost" => 11]);
	}

}