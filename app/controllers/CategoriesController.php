<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
    Phalcon\Paginator\Adapter\Model as Paginator,
	Phalcon\Tag as Tag;
	
use Abstaff\Models\Categories as Categories;

class CategoriesController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->setVar("categories", Categories::find());
		Tag::appendTitle('Categories Overview');
		
    }

    /**
     * Searches for categories
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Categories", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "name";

        $categories = Categories::find($parameters);
        if (count($categories) == 0) {
            $this->flash->notice("The search did not find any categories");
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $categories,
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
		Tag::appendTitle('Add New Category');
    }

    /**
     * Edits a category
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $category = Categories::findFirstByid($id);
            if (!$category) {
                $this->flash->error("category was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "categories",
                    "action" => "index"
                ));
            }

            $this->view->id = $category->id;

            $this->tag->setDefault("id", $category->id);
            $this->tag->setDefault("name", $category->name);
            $this->tag->setDefault("description", $category->description);
			Tag::appendTitle('Edit Category');
            
        }
    }

    /**
     * Creates a new category
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        $category = new Categories();

        $category->id = $this->request->getPost("id");
        $category->name = $this->request->getPost("name");
        $category->description = $this->request->getPost("description");
        

        if (!$category->save()) {
            foreach ($category->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "new"
            ));
        }

        $this->flash->success("category was created successfully");
        return $this->dispatcher->forward(array(
            "controller" => "categories",
            "action" => "index"
        ));

    }

    /**
     * Saves a category edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $category = Categories::findFirstByid($id);
        if (!$category) {
            $this->flash->error("category does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        $category->id = $this->request->getPost("id");
        $category->name = $this->request->getPost("name");
        $category->description = $this->request->getPost("description");
        

        if (!$category->save()) {

            foreach ($category->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "edit",
                "params" => array($category->id)
            ));
        }

        $this->flash->success("category was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "categories",
            "action" => "index"
        ));

    }

    /**
     * Deletes a category
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $category = Categories::findFirstByid($id);
        if (!$category) {
            $this->flash->error("category was not found");
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        if (!$category->delete()) {

            foreach ($category->getMessages() as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "search"
            ));
        }

        $this->flash->success("category was deleted successfully");
        return $this->dispatcher->forward(array(
            "controller" => "categories",
            "action" => "index"
        ));
    }
	
	public function showAction($categoryName)
	{
		$category = Categories::findFirst(array(
			'name = ?0', 'bind' => array(str_replace('_',' ', strtolower($categoryName)))
		));
		$this->view->setVar("category", $category);
		Tag::appendTitle('View Category Details');
	}

}
