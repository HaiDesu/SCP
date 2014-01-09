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

class IndexController extends ControllerBase
{

    public function indexAction()
    {
		//$identity = $this->session->get('auth-identity');
		//$this->view->setVar("user23", $this->session->get('auth'));
		
		/*$phql = 'SELECT g.name
				FROM Abstaff\Models\SeriesGenres sg
				JOIN Abstaff\Models\Genres g
				WHERE sg.seriesId = '.$series->id;*/
		//$series->genres = $this->modelsManager->executeQuery($phql);
		
		$phql = "SELECT Series.*, 
				GROUP_CONCAT(Genres.name) AS genres 
				FROM Series 
				LEFT OUTER JOIN series_genres ON series.id = series_genres.seriesId 
				LEFT OUTER JOIN genres ON genres.id = series_genres.genresId";
		//$series = $this->modelsManager->executeQuery($phql);
		
		$sql = "SELECT s.*, st.name, 
				GROUP_CONCAT(g.name) genres 
				FROM Abstaff\Models\Series s 
				LEFT OUTER JOIN Abstaff\Models\SeriesGenres sg ON sg.seriesId = s.id 
				LEFT OUTER JOIN Abstaff\Models\Genres g ON g.id = sg.genresId 
				LEFT OUTER JOIN Abstaff\Models\SeriesTypes st ON st.id = s.type 
				GROUP BY s.id";
		
		$result = $this->modelsManager->executeQuery($sql);
		
		//$series = $query->execute(array('name' => 'Audi'));
		
		
		$this->view->setVar("result", $result);
    }
	
	public function testAction()
	{
		
	}
	
}

