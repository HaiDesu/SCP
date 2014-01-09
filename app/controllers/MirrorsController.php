<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Model\Criteria,
	Phalcon\Mvc\View,
	Phalcon\Db\RawValue as RawValue,
    Phalcon\Paginator\Adapter\Model as Paginator,
	Phalcon\Tag as Tag;
	
use Abstaff\Models\Mirrors as Mirrors,
	Abstaff\Models\Episodes as Episodes,
	Abstaff\Models\Series as Series;

class MirrorsController extends ControllerBase
{

	public function indexAction()
	{
		Tag::appendTitle('Mirrors Index');
		
		$sql = "SELECT m.*, s.slug series_slug, s.title series, s.id series_id, s.poster series_poster, e.number episode_number, e.title episode_title, v.name videohost, mt.shortcode mirror_type, u.username username
				FROM Abstaff\Models\Mirrors m
				LEFT OUTER JOIN Abstaff\Models\Videohosts v ON v.id = m.vhost 
				LEFT OUTER JOIN Abstaff\Models\MirrorTypes mt ON mt.id = m.mtype 
				LEFT OUTER JOIN Abstaff\Models\Episodes e ON e.id = m.episode_id 
				LEFT OUTER JOIN Abstaff\Models\Series s ON s.id = e.series_id 
				LEFT OUTER JOIN Abstaff\Models\Users u ON u.id = m.user 
				WHERE m.isApproved = 'N'";
		
		$mirrors_not_approved = $this->modelsManager->executeQuery($sql);
		
		$this->view->setVar("mirrors_not_approved", $mirrors_not_approved);
	}
	
	public function newAction()
	{
		//
	}
	
	public function addmirrorAction()
	{		
		$this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
		$this->view->disableLevel(View::LEVEL_LAYOUT);
		
		// Initiate Phase2 of Form
		if ($this->request->getPost('phase') == 'episode') { 
			$episodes = Episodes::find(array(
				'series_id = ?0', 'order' => 'number DESC', 'bind' => array($this->request->getPost('sid', 'int'))
			));
			$this->view->setVar('episodes', $episodes);
			$this->view->pick("mirrors/partial_add_phase2");
		}
		
		// Initiate Video validation of Form
		if ($this->request->getPost('phase') == 'validate') {
			
			$video = parse_url($this->request->getPost('video_url', 'striptags'));
			
			if ($video == false) { echo 'Error parsing URL.';die; }
			
			switch(mb_strtolower($video['host']))
			{
				case 'aniupload.com';
					$parsed = $this->_aniupload($video); 
				break;
				case 'mp4upload.com';
				case 'www.mp4upload.com';
					$parsed = $this->_mp4upload($video);
				break;
				default;
					$error = 'Video host not recognized/supported!';
					$parsed = null;
				break;
			}
			
			if ($parsed !== null) {
				$mirror['series'] = $this->request->getPost('sid', 'int');
				$mirror['episode'] = $this->request->getPost('episode_id', 'int');
				$mirror['type'] = $this->request->getPost('mirror_type', 'int');
				$mirror['vhost_uid'] = $parsed['vhost_uid'];
				$mirror['vhost_id'] = $parsed['vhost'];
				$mirror['vhost_name'] = $parsed['vhost_name'];
				$mirror['vhost_domain'] = $parsed['vhost_domain'];
				$mirror['iframe_url'] = $parsed['iframe_url'];
				
			} elseif ($parsed === null && isset($error)) {
				
				$mirror['error'] = $error;
				
			}
			$this->view->setVar('mirror', $mirror);
			$this->view->pick("mirrors/partial_add_validate");
		}
	}
	
	public function createAction()
	{
		if ($this->request->isPost()) {
		
			$mirror = new Mirrors();
			$mirror->episode_id = $this->request->getPost('episode');
			$mirror->mtype = $this->request->getPost('videotype');
			$mirror->vhost = $this->request->getPost('vhost');
			$mirror->vhost_domain = $this->request->getPost('vhost_domain');
			$mirror->vhost_uid = $this->request->getPost('vhost_uid');
			$mirror->user = $this->request->getPost('user_id');
			$mirror->dateAdded = new RawValue('now()');
			$mirror->isApproved = 'N';
			
			if (!$mirror->create()) {
				foreach ($mirror->getMessages() as $message) {
					$this->flash->error($message);
				}
				return $this->dispatcher->forward(array(
					"controller" => "mirrors",
					"action" => "new"
				));
			}
			
			$this->flash->success("mirror was created successfully. Add MOAR!");
			return $this->dispatcher->forward(array(
				"controller" => "mirrors",
				"action" => "new"
			));
		
		}
	}
	
	private function _aniupload($video)
	{
		$var['vhost_uid'] = trim($video['path'], "/");
		$var['vhost'] = 1;
		$var['vhost_name'] = 'AniUpload';
		$var['vhost_domain'] = $video['host'];
		$var['iframe_url'] = 'http://'.$var['vhost_domain'].'/embed-'.$var['vhost_uid'].'.html';
		return $var;
	}
	
	private function _mp4upload($video)
	{
		$var['vhost_uid'] = trim($video['path'], "/");
		$var['vhost'] = 2;
		$var['vhost_name'] = 'Mp4Upload';
		$var['vhost_domain'] = $video['host'];
		$var['iframe_url'] = 'http://'.$var['vhost_domain'].'/embed-'.$var['vhost_uid'].'.html';
		return $var;
	}

}