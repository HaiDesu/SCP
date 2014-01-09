<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
	Phalcon\Db\RawValue as RawValue,
    Phalcon\Paginator\Adapter\Model as Paginator,
	Phalcon\Tag as Tag;
	
use Abstaff\Models\Videohosts as Videohosts;

class VideohostsController extends ControllerBase
{

	   /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->setVar("vhosts", Videohosts::find());
		
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a mirror type
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $vhost = Videohosts::findFirstByid($id);
            if (!$vhost) {
                $this->flash->error("videohost was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "videohosts",
                    "action" => "index"
                ));
            }

            $this->view->id = $vhost->id;

            $this->tag->setDefault("id", $vhost->id);
            $this->tag->setDefault("name", $vhost->name);
            
        }
    }

    /**
     * Creates a videohost
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "videohosts",
                "action" => "index"
            ));
        }

        $vhost = new Videohosts();

        $vhost->name = $this->request->getPost("name", "string");
        

        if (!$vhost->save()) {
            foreach ($vhost->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "videohosts",
                "action" => "new"
            ));
        }

        $this->flash->success("videohost was created successfully");
        return $this->dispatcher->forward(array(
            "controller" => "videohosts",
            "action" => "index"
        ));

    }

    /**
     * Saves an edited videohost
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "videohosts",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $vhost = Videohosts::findFirstByid($id);
        if (!$vhost) {
            $this->flash->error("videohost does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "videohosts",
                "action" => "index"
            ));
        }

        $vhost->id = $this->request->getPost("id");
        $vhost->name = $this->request->getPost("name");
        

        if (!$vhost->save()) {

            foreach ($vhost->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "videohosts",
                "action" => "edit",
                "params" => array($vhost->id)
            ));
        }

        $this->flash->success("videohost was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "videohosts",
            "action" => "index"
        ));

    }

    /**
     * Deletes a vhost
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $vhost = Videohosts::findFirstByid($id);
        if (!$vhost) {
            $this->flash->error("videohost was not found");
            return $this->dispatcher->forward(array(
                "controller" => "videohosts",
                "action" => "index"
            ));
        }

        if (!$vhost->delete()) {

            foreach ($vhost->getMessages() as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "videohosts",
                "action" => "search"
            ));
        }

        $this->flash->success("videohost was deleted successfully");
        return $this->dispatcher->forward(array(
            "controller" => "videohosts",
            "action" => "index"
        ));
    }
	
	/**
     * Shows a vhost
     *
     * @param string $name
     */
	public function showAction($name)
	{
		$vhost = MirrorTypes::findFirst(array(
			'name = ?0', 'bind' => array($name)
		));
		$this->view->setVar("vhost", $vhost);
	}

}