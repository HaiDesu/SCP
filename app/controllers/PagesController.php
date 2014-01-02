<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
    Phalcon\Paginator\Adapter\Model as Paginator;
	
use Abstaff\Models\Pages as Pages;

class PagesController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->setVar("pages", Pages::find());
		
    }

    /**
     * Displays the create form
     */
    public function newAction()
    {

    }

    /**
     * Edits a page
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $page = Pages::findFirstByid($id);
            if (!$page) {
                $this->flash->error("page was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "pages",
                    "action" => "index"
                ));
            }

            $this->view->id = $page->id;

            $this->tag->setDefault("id", $page->id);
            $this->tag->setDefault("title", $page->title);
            $this->tag->setDefault("slug", $page->slug);
            $this->tag->setDefault("content", $page->content);
            
        }
    }

    /**
     * Creates a new page
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "pages",
                "action" => "index"
            ));
        }

        $page = new Pages();

        $page->title = $this->request->getPost("title");
        $page->slug = $this->request->getPost("slug");
        $page->content = $this->request->getPost("content");
        

        if (!$page->save()) {
            foreach ($page->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "pages",
                "action" => "new"
            ));
        }

        $this->flash->success("page was created successfully");
        return $this->dispatcher->forward(array(
            "controller" => "pages",
            "action" => "index"
        ));

    }

    /**
     * Saves an edited page
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "pages",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $page = Pages::findFirstByid($id);
        if (!$page) {
            $this->flash->error("page does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "pages",
                "action" => "index"
            ));
        }

        $page->id = $this->request->getPost("id");
        $page->title = $this->request->getPost("title");
        $page->slug = $this->request->getPost("slug");
        $page->content = $this->request->getPost("content");        

        if (!$page->save()) {

            foreach ($page->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pages",
                "action" => "edit",
                "params" => array($page->id)
            ));
        }

        $this->flash->success("page was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "pages",
            "action" => "index"
        ));

    }

    /**
     * Deletes a page
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $page = Pages::findFirstByid($id);
        if (!$page) {
            $this->flash->error("page was not found");
            return $this->dispatcher->forward(array(
                "controller" => "pages",
                "action" => "index"
            ));
        }

        if (!$page->delete()) {

            foreach ($page->getMessages() as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pages",
                "action" => "search"
            ));
        }

        $this->flash->success("page was deleted successfully");
        return $this->dispatcher->forward(array(
            "controller" => "pages",
            "action" => "index"
        ));
    }
	
	public function showAction($slug)
	{
		$page = Pages::findFirst(array(
			'slug = ?0', 'bind' => array($slug)
		));
		$this->view->setVar("page", $page);
	}

}
