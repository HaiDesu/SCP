<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
	Phalcon\Db\RawValue as RawValue,
    Phalcon\Paginator\Adapter\Model as Paginator,
	Phalcon\Tag as Tag;
	
use Abstaff\Models\MirrorTypes as MirrorTypes;

class MirrorTypesController extends ControllerBase
{

	   /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->setVar("mirror_types", MirrorTypes::find());
		
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

            $mirror_type = MirrorTypes::findFirstByid($id);
            if (!$mirror_type) {
                $this->flash->error("mirror type was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "mirror_types",
                    "action" => "index"
                ));
            }

            $this->view->id = $mirror_type->id;

            $this->tag->setDefault("id", $mirror_type->id);
            $this->tag->setDefault("name", $mirror_type->name);
            $this->tag->setDefault("shortcode", $mirror_type->shortcode);
            $this->tag->setDefault("description", $mirror_type->description);
            
        }
    }

    /**
     * Creates a new mirror type
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "mirror_types",
                "action" => "index"
            ));
        }

        $mirror_type = new MirrorTypes();

        $mirror_type->name = $this->request->getPost("name", "string");
        $mirror_type->shortcode = $this->request->getPost("shortcode");
        $mirror_type->description = $this->request->getPost("description");
        

        if (!$mirror_type->save()) {
            foreach ($mirror_type->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "mirror_types",
                "action" => "new"
            ));
        }

        $this->flash->success("mirror type was created successfully");
        return $this->dispatcher->forward(array(
            "controller" => "mirror_types",
            "action" => "index"
        ));

    }

    /**
     * Saves an edited mirror type
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "mirror_types",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $mirror_type = MirrorTypes::findFirstByid($id);
        if (!$mirror_type) {
            $this->flash->error("mirror type does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "mirror_types",
                "action" => "index"
            ));
        }

        $mirror_type->id = $this->request->getPost("id");
        $mirror_type->name = $this->request->getPost("name");
        $mirror_type->shortcode = $this->request->getPost("shortcode");
        $mirror_type->description = $this->request->getPost("description");
        

        if (!$mirror_type->save()) {

            foreach ($mirror_type->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "mirror_types",
                "action" => "edit",
                "params" => array($mirror_type->id)
            ));
        }

        $this->flash->success("mirror type was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "mirror_types",
            "action" => "index"
        ));

    }

    /**
     * Deletes a mirror type
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $mirror_type = MirrorTypes::findFirstByid($id);
        if (!$mirror_type) {
            $this->flash->error("Mirror Type was not found");
            return $this->dispatcher->forward(array(
                "controller" => "mirror_types",
                "action" => "index"
            ));
        }

        if (!$mirror_type->delete()) {

            foreach ($mirror_type->getMessages() as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "mirror_types",
                "action" => "search"
            ));
        }

        $this->flash->success("mirror type was deleted successfully");
        return $this->dispatcher->forward(array(
            "controller" => "mirror_types",
            "action" => "index"
        ));
    }
	
	/**
     * Shows a mirror type
     *
     * @param string $name
     */
	public function showAction($shortcode)
	{
		$mirror_type = MirrorTypes::findFirst(array(
			'shortcode = ?0', 'bind' => array($shortcode)
		));
		$this->view->setVar("mirror_type", $mirror_type);
	}

}