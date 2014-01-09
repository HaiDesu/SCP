<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
	Phalcon\Db\RawValue as RawValue,
    Phalcon\Paginator\Adapter\Model as Paginator,
	Phalcon\Tag as Tag;
	
use Abstaff\Models\Episodes as Episodes,
	Abstaff\Models\Series as Series;

class EpisodesController extends ControllerBase
{

	public function indexAction()
	{
		$series = Series::find();
		$this->view->setVar("series", $series);
	}
	
	public function newAction()
	{
		//set if request isPost
		
		$id = $this->request->getPost('series', 'int');
		$series = Series::findFirstByid($id);
		$series->type = $series->getType();
		$series->episodeslist = Episodes::find(array(
			'series_id = ?0', 'bind' => array($series->id)
		));
		
		if (count($series->episodeslist) !== 0) {
			$arr_c = count($series->episodeslist) - 1;
			$series->lastep = $series->episodeslist["$arr_c"];
			$series->lastep = $series->lastep->number;
		}
		if (count($series->episodeslist) == 0) {
			$series->lastep = 0;
		}
		
		$this->view->setVar("series", $series);
		//$this->view->setVar("lastepnum", $lastepnum);
	}
	
	public function createsingleAction()
	{
		if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "episodes",
                "action" => "index"
            ));
        }
		
		if ($this->request->isPost('epstarts') !== null) {
			$ep = new Episodes();
			$ep->series_id = $this->request->getPost('sid', 'int');
			$ep->number = $this->request->getPost('epstarts');
			$ep->save();
			if (!$ep->save()) {
				foreach ($ep->getMessages() as $message) {
					$this->flash->error($message);
				}
				return $this->dispatcher->forward(array("controller" => "episodes", "action" => "index"));
			}
			$this->flash->success("episode added successfully");
			return $this->dispatcher->forward(array("controller" => "episodes", "action" => "index"));
		}
		return $this->dispatcher->forward(array("controller" => "episodes", "action" => "index"));
		
	}
	
	public function createmultiAction()
	{
		if ($this->request->isPost('epstart') !== null) {
			$amt = $this->request->getPost('epamt');
			$start = $this->request->getPost('epstart');
			$end = $start + $amt;
			
			$i = $start;
			while($i <= $end)
			{
				$ep = new Episodes();
				$ep->series_id = $this->request->getPost('sid');
				$ep->number = $i;
				$ep->save();
				$i++;
			}
			$this->flash->success("episodes added successfully");
			return $this->dispatcher->forward(array("controller" => "episodes", "action" => "index"));
		}
		return $this->dispatcher->forward(array("controller" => "episodes", "action" => "index"));
	}

}