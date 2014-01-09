<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
	Phalcon\Tag as Tag,
	Phalcon\Db\RawValue as RawValue,
    Phalcon\Paginator\Adapter\Model as Paginator;
	
use Abstaff\Models\Articles as Articles,
	Abstaff\Models\ArticleCategories as ArticleCategories,
	Abstaff\Models\Users as Users;

class ArticlesController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        Tag::appendTitle('Articles Overview');
		$this->view->setVar("articles", Articles::find());
		
    }

    /**
     * Displays the create form
     */
    public function newAction()
    {
		Tag::appendTitle('Create Article');
    }

    /**
     * Edits an article
     *
     * @param string $id
     */
    public function editAction($id)
    {

        Tag::appendTitle('Edit Article');
		if (!$this->request->isPost()) {

            $article = Articles::findFirstByid($id);
            if (!$article) {
                $this->flash->error("article was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "articles",
                    "action" => "index"
                ));
            }

            $this->view->id = $article->id;

            $this->tag->setDefault("id", $article->id);
            $this->tag->setDefault("title", $article->title);
            $this->tag->setDefault("slug", $article->slug);
            $this->tag->setDefault("category", $article->category);
            $this->tag->setDefault("content", $article->content);
            $this->tag->setDefault("isPublished", $article->isPublished);
            
        }
    }

    /**
     * Creates a new article
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "articles",
                "action" => "index"
            ));
        }

        $article = new Articles();

        $article->title = $this->request->getPost("title");
        $article->slug = str_replace(' ','_', strtolower($article->title));
        $article->content = $this->request->getPost("content");
        $article->category = $this->request->getPost("category");
        $article->isPublished = $this->request->getPost("isPublished");
        $article->author = $this->request->getPost("author");
        $article->createdOn = new RawValue('now()');
        $article->views = 1;
        

        if (!$article->save()) {
            foreach ($article->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "articles",
                "action" => "new"
            ));
        }

        $this->flash->success("article was created successfully");
        return $this->dispatcher->forward(array(
            "controller" => "articles",
            "action" => "index"
        ));

    }

    /**
     * Saves an edited article
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "articles",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $article = Articles::findFirstByid($id);
        if (!$article) {
            $this->flash->error("article does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "articles",
                "action" => "index"
            ));
        }

        $article->id = $this->request->getPost("id");
        $article->title = $this->request->getPost("title");
        $article->slug = $this->request->getPost("slug");
        $article->content = $this->request->getPost("content");        
        $article->isPublished = $this->request->getPost("isPublished");        

        if (!$article->save()) {

            foreach ($article->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "articles",
                "action" => "edit",
                "params" => array($article->id)
            ));
        }

        $this->flash->success("article was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "articles",
            "action" => "index"
        ));

    }

    /**
     * Deletes an article
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $article = Articles::findFirstByid($id);
        if (!$article) {
            $this->flash->error("article was not found");
            return $this->dispatcher->forward(array(
                "controller" => "articles",
                "action" => "index"
            ));
        }

        if (!$article->delete()) {

            foreach ($article->getMessages() as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "articles",
                "action" => "search"
            ));
        }

        $this->flash->success("article was deleted successfully");
        return $this->dispatcher->forward(array(
            "controller" => "articles",
            "action" => "index"
        ));
    }
	
	public function showAction($slug)
	{
		$article = Articles::findFirst(array(
			'slug = ?0', 'bind' => array($slug)
		));
		$article->category = ArticleCategories::findFirstByid($article->category);
		$article->author = Users::findFirstByid($article->author);
		
		$this->view->setVar("article", $article);
	}

}
