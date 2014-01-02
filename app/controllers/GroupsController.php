<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
    Phalcon\Paginator\Adapter\Model as Paginator;
	
use Abstaff\Models\Groups as Groups;

class GroupsController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->setVar("groups", Groups::find());
		
    }

    /**
     * Displays the create form
     */
    public function newAction()
    {

    }

    /**
     * Edits a group
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $group = Groups::findFirstByid($id);
            if (!$group) {
                $this->flash->error("group was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "groups",
                    "action" => "index"
                ));
            }

            $this->view->id = $group->id;

            $this->tag->setDefault("id", $group->id);
            $this->tag->setDefault("name", $group->name);
            $this->tag->setDefault("description", $group->description);
            
        }
    }

    /**
     * Creates a new group
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "index"
            ));
        }

        $group = new Groups();

        $group->id = $this->request->getPost("id");
        $group->name = $this->request->getPost("name");
        $group->description = $this->request->getPost("description");
        

        if (!$group->save()) {
            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "new"
            ));
        }

        $this->flash->success("group was created successfully");
        return $this->dispatcher->forward(array(
            "controller" => "groups",
            "action" => "index"
        ));

    }

    /**
     * Saves an edited group
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $group = Groups::findFirstByid($id);
        if (!$group) {
            $this->flash->error("group does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "index"
            ));
        }

        $group->id = $this->request->getPost("id");
        $group->name = $this->request->getPost("name");
        $group->description = $this->request->getPost("description");       

        if (!$group->save()) {

            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "edit",
                "params" => array($group->id)
            ));
        }

        $this->flash->success("group was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "groups",
            "action" => "index"
        ));

    }

    /**
     * Deletes a group
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $group = Groups::findFirstByid($id);
        if (!$group) {
            $this->flash->error("group was not found");
            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "index"
            ));
        }

        if (!$group->delete()) {

            foreach ($group->getMessages() as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "search"
            ));
        }

        $this->flash->success("group was deleted successfully");
        return $this->dispatcher->forward(array(
            "controller" => "groups",
            "action" => "index"
        ));
    }
	
	public function showAction($name)
	{
		$namee = str_replace('_', ' ', $name);
		$group = Groups::findFirst(array(
			'name = ?0', 'bind' => array($namee)
		));
		$this->view->setVar("group", $group);
	}

}
