<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
    Phalcon\Paginator\Adapter\Model as Paginator;
	
use Abstaff\Models\Stypes as Stypes;
	
/**
 *
 * Series type Controller [TV|Movie|OVA|OAD|ONA]
 */
class StypesController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->setVar("stypes", Stypes::find());
		
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a stype
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $stype = Stypes::findFirstByid($id);
            if (!$stype) {
                $this->flash->error("series type was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "stypes",
                    "action" => "index"
                ));
            }

            $this->view->id = $stype->id;

            $this->tag->setDefault("id", $stype->id);
            $this->tag->setDefault("label", $stype->label);
            $this->tag->setDefault("description", $stype->description);
            
        }
    }

    /**
     * Creates a new series type
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "stypes",
                "action" => "index"
            ));
        }

        $stype = new Stypes();

        $stype->id = $this->request->getPost("id");
        $stype->label = $this->request->getPost("label");
        $stype->description = $this->request->getPost("description");
        

        if (!$stype->save()) {
            foreach ($stype->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "stypes",
                "action" => "new"
            ));
        }

        $this->flash->success("series type was created successfully");
        return $this->dispatcher->forward(array(
            "controller" => "stypes",
            "action" => "index"
        ));

    }

    /**
     * Saves a series type edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "stypes",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $stype = Stypes::findFirstByid($id);
        if (!$stype) {
            $this->flash->error("series type does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "stypes",
                "action" => "index"
            ));
        }

        $stype->id = $this->request->getPost("id");
        $stype->label = $this->request->getPost("label");
        $stype->description = $this->request->getPost("description");
        

        if (!$stype->save()) {

            foreach ($stype->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "stypes",
                "action" => "edit",
                "params" => array($stype->id)
            ));
        }

        $this->flash->success("stype was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "stypes",
            "action" => "index"
        ));

    }

    /**
     * Deletes a stype
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $stype = Stypes::findFirstByid($id);
        if (!$stype) {
            $this->flash->error("Series Type was not found");
            return $this->dispatcher->forward(array(
                "controller" => "stypes",
                "action" => "index"
            ));
        }

        if (!$stype->delete()) {

            foreach ($stype->getMessages() as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "stypes",
                "action" => "search"
            ));
        }

        $this->flash->success("series type was deleted successfully");
        return $this->dispatcher->forward(array(
            "controller" => "stypes",
            "action" => "index"
        ));
    }
	
	/**
     * Shows a stype
     *
     * @param string $label
     */
	public function showAction($stypeName)
	{
		$genre = Stypes::findFirst(array(
			'label = ?0', 'bind' => array(str_replace('_',' ', strtolower($stypeName)))
		));
		$this->view->setVar("stype", $stype);
	}

}
