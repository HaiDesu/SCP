<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
    Phalcon\Paginator\Adapter\Model as Paginator;
	
use Abstaff\Models\Genres as Genres;

class GenresController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->setVar("genres", Genres::find());
		
    }

    /**
     * Searches for genres
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Genres", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "label";

        $genres = Genres::find($parameters);
        if (count($genres) == 0) {
            $this->flash->notice("The search did not find any genres");
            return $this->dispatcher->forward(array(
                "controller" => "genres",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $genres,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a genre
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $genre = Genres::findFirstByid($id);
            if (!$genre) {
                $this->flash->error("genre was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "genres",
                    "action" => "index"
                ));
            }

            $this->view->id = $genre->id;

            $this->tag->setDefault("id", $genre->id);
            $this->tag->setDefault("label", $genre->label);
            $this->tag->setDefault("description", $genre->description);
            
        }
    }

    /**
     * Creates a new genre
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "genres",
                "action" => "index"
            ));
        }

        $genre = new Genres();

        $genre->id = $this->request->getPost("id");
        $genre->label = $this->request->getPost("label");
        $genre->description = $this->request->getPost("description");
        

        if (!$genre->save()) {
            foreach ($genre->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "genres",
                "action" => "new"
            ));
        }

        $this->flash->success("genre was created successfully");
        return $this->dispatcher->forward(array(
            "controller" => "genres",
            "action" => "index"
        ));

    }

    /**
     * Saves a genre edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "genres",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $genre = Genres::findFirstByid($id);
        if (!$genre) {
            $this->flash->error("genre does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "genres",
                "action" => "index"
            ));
        }

        $genre->id = $this->request->getPost("id");
        $genre->label = $this->request->getPost("label");
        $genre->description = $this->request->getPost("description");
        

        if (!$genre->save()) {

            foreach ($genre->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "genres",
                "action" => "edit",
                "params" => array($genre->id)
            ));
        }

        $this->flash->success("genre was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "genres",
            "action" => "index"
        ));

    }

    /**
     * Deletes a genre
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $genre = Genres::findFirstByid($id);
        if (!$genre) {
            $this->flash->error("genre was not found");
            return $this->dispatcher->forward(array(
                "controller" => "genres",
                "action" => "index"
            ));
        }

        if (!$genre->delete()) {

            foreach ($genre->getMessages() as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "genres",
                "action" => "search"
            ));
        }

        $this->flash->success("genre was deleted successfully");
        return $this->dispatcher->forward(array(
            "controller" => "genres",
            "action" => "index"
        ));
    }
	
	public function showAction($genreName)
	{
		$genre = Genres::findFirst(array(
			'label = ?0', 'bind' => array(str_replace('_',' ', strtolower($genreName)))
		));
		$this->view->setVar("genre", $genre);
	}

}
