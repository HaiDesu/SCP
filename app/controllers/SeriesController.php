<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
	Phalcon\Tag as Tag,
	Phalcon\Db\RawValue as RawValue,
    Phalcon\Paginator\Adapter\Model as Paginator;
	
use Abstaff\Models\Series as Series,
	Abstaff\Models\Episodes as Episodes,
	Abstaff\Models\SeriesTypes as SeriesTypes,
	Abstaff\Models\Genres as Genres,
	Abstaff\Models\SeriesGenres as SeriesGenres,
	Abstaff\Models\SeriesPresequel as SeriesPresequel;

class SeriesController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $sql = "SELECT s.*, st.name, 
				GROUP_CONCAT(g.name) genres 
				FROM Abstaff\Models\Series s 
				LEFT OUTER JOIN Abstaff\Models\SeriesGenres sg ON sg.seriesId = s.id 
				LEFT OUTER JOIN Abstaff\Models\Genres g ON g.id = sg.genresId 
				LEFT OUTER JOIN Abstaff\Models\SeriesTypes st ON st.id = s.type 
				GROUP BY s.id";
		
		$series1 = $this->modelsManager->executeQuery($sql);
		
		Tag::appendTitle('Series Overview');	
		$this->view->setVar("series1", $series1);
		
    }

    /**
     * Displays the create form
     */
    public function newAction()
    {
		Tag::appendTitle('Add Series');
		$this->view->setVar("genres", Genres::find());
    }

    /**
     * Edits a series
     *
     * @param string $id
     */
    public function editAction($id)
    {

        Tag::appendTitle('Edit Series');
		if (!$this->request->isPost()) {

            $series = Series::findFirstByid($id);
            if (!$series) {
                $this->flash->error("series was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "series",
                    "action" => "index"
                ));
            }

            $this->view->id = $series->id;

            $this->tag->setDefault("id", $series->id);
            $this->tag->setDefault("title", $series->title);
            $this->tag->setDefault("altTitle", $series->altTitle);
            $this->tag->setDefault("slug", $series->slug);
            $this->tag->setDefault("type", $series->type);
            $this->tag->setDefault("episodes", $series->episodes);
            $this->tag->setDefault("status", $series->status);
            $this->tag->setDefault("synopsis", $series->synopsis);
            $this->tag->setDefault("poster", $series->poster);
			
			$genres = SeriesGenres::find(array(
				'seriesId = ?0', 'bind' => array($series->id)
			));
			$this->view->setVar("genreslist", Genres::find());
			$this->view->setVar("genres", $genres);
            
        }
    }

    /**
     * Creates a new series
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "series",
                "action" => "index"
            ));
        }
		
		// add series to series table
		$series = new Series();
        $series->title = trim($this->request->getPost("title", "striptags"));
        $series->altTitle = $this->request->getPost("altTitle", "striptags");
        $series->slug = rawurlencode(str_replace(' ','_', mb_strtolower($series->title)));
        $series->type = $this->request->getPost("type", "trim");
        $series->episodes = $this->request->getPost("episodes", "int");
        $series->status = $this->request->getPost("status" , "trim");
        $series->synopsis = $this->request->getPost("synopsis", "trim");
        $series->poster = strip_tags($this->request->getPost("poster", "trim"));
        $series->dateAdded = new RawValue('now()');
		$series->save();

		if (!$series->save()) {
            foreach ($series->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array("controller" => "series", "action" => "new"));
        }
		
		// add genres to series_genres table
		$genres = $this->request->getPost("genres");
		foreach ($genres as $genre) {
			$sg = new SeriesGenres();
			$sg->seriesId = $series->id;
			$sg->genresId = $genre;
			$sg->save();
			
			if (!$sg->save()) {
				foreach ($sg->getMessages() as $message) {
					$this->flash->error($message);
				}
				return $this->dispatcher->forward(array("controller" => "series", "action" => "new"));
			}
		}
		
		// add episodes to episodes table
		$episodes = $series->episodes;
		if (isset($episodes)) {
			$i=1;
			while($i<=$episodes)
			{
				$ep = new Episodes();
				$ep->series_id = $series->id;
				$ep->number = $i;
				$ep->save();
				$i++;
			}
		}
		
        $this->flash->success("series was created successfully");
        return $this->dispatcher->forward(array("controller" => "series", "action" => "index"));

    }

    /**
     * Saves an edited series
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "series",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $series = Series::findFirstByid($id);
        if (!series) {
            $this->flash->error("series does not exist " . $id);
            return $this->dispatcher->forward(array(
                "controller" => "series",
                "action" => "index"
            ));
        }

        $series->id = $this->request->getPost("id");
        $series->title = trim($this->request->getPost("title", "striptags"));
        $series->altTitle = $this->request->getPost("altTitle", "striptags");
        $series->slug = rawurlencode(str_replace(' ','_', mb_strtolower($series->title)));
        $series->type = $this->request->getPost("type", "trim");
        $series->episodes = $this->request->getPost("episodes", "int");
        $series->status = $this->request->getPost("status" , "trim");
        $series->synopsis = $this->request->getPost("synopsis", "trim");
        $series->poster = strip_tags($this->request->getPost("poster", "trim"));

        if (!$series->save()) {

            foreach ($series->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "series",
                "action" => "edit",
                "params" => array($series->id)
            ));
        }

        $this->flash->success("series was updated successfully");
        return $this->dispatcher->forward(array(
            "controller" => "series",
            "action" => "index"
        ));

    }

    /**
     * Deletes a series
     *
     * @param int $id
     */
    public function deleteAction($id)
    {

        $series = Series::findFirstByid($id);
        if (!$series) {
            $this->flash->error("series was not found");
            return $this->dispatcher->forward(array(
                "controller" => "series",
                "action" => "index"
            ));
        }

        if (!$series->delete()) {

            foreach ($series->getMessages() as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "series",
                "action" => "search"
            ));
        }

        $this->flash->success("series was deleted successfully");
        return $this->dispatcher->forward(array(
            "controller" => "series",
            "action" => "index"
        ));
    }
	
	/**
     * Displays a series and related info
     *
     * @param string $slug
     */
	public function showAction($slug)
	{
		$series = Series::findFirst(array(
			'slug = ?0', 'bind' => array(rawurlencode($slug))
		));
		$series->episodeslist = Episodes::find(array(
			'series_id = ?0', 'bind' => array($series->id)
		));
		$series->type = $series->getType();		
		$phql = 'SELECT g.name
				FROM Abstaff\Models\SeriesGenres sg
				JOIN Abstaff\Models\Genres g
				WHERE sg.seriesId = '.$series->id;
		$series->genres = $this->modelsManager->executeQuery($phql);
		$series->prequel = Series::getPrequel($series->id);
		$series->sequel = Series::getSequel($series->id);
		$this->view->setVar("series", $series);
	}
	
	/**
     * Displays the series relations page
     *
     */
	public function relationsAction()
	{
		Tag::appendTitle('New Prequel/Sequel Relationship');
		$this->view->setVar("series", Series::find());
	}
	
	/**
     * Creates a Prequel/Sequel relation in db with post data via form
     *
     */
	public function prequelsequelcreateAction()
	{
		$request = $this->request;		
        if ($request->isPost()) {		
			if ($request->getPost('prequel') == $request->getPost('sequel')) {			
				$this->flash->error("much retard. such wow. Prequel and Sequel cannot be the same!");
                return $this->dispatcher->forward(array("controller" => "series","action" => "relations"));				
			}			
			$ps = new SeriesPresequel();
			$ps->prequel_id = $request->getPost('prequel', 'int');
			$ps->sequel_id = $request->getPost('sequel', 'int');			
			if ($ps->prequel_id == $ps->sequel_id) {		
				$this->flash->error("much retard. such wow. Prequel and Sequel cannot be the same!");
                return $this->dispatcher->forward(array("controller" => "series","action" => "relations"));				
			}			
			if (!$ps->create()) {			
				$this->flash->error("Prequel/Sequel relation not saved!");
                return $this->dispatcher->forward(array("controller" => "series","action" => "relations"));				
			}			
			$this->flash->success("Prequel/Sequel created successfully!");
            return $this->dispatcher->forward(array("controller" => "series","action" => "relations"));	
		}		
		return $this->forward('series/relation');
	}

}
