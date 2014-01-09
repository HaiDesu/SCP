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

class AjaxController extends ControllerBase
{

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
			switch(mb_strtolower($video['host']))
			{
				case 'aniupload.com';
					$parsed = $this->_aniupload($video); 
				break;
				case 'mp4upload.com';
					$parsed = $this->_mp4upload($video);
				break;
				default;
					$parsed = null;
					$hostError = 'Video host not recognized!';
				break;
			}
			
			$mirror['series'] = $this->request->getPost('sid', 'int');
			$mirror['episode'] = $this->request->getPost('episode_id', 'int');
			$mirror['type'] = $this->request->getPost('mirror_type', 'int');
			$mirror['vhost_uid'] = $parsed['vhost_uid'];
			$mirror['vhost_id'] = $parsed['vhost'];
			$mirror['vhost_name'] = $parsed['vhost_name'];
			$mirror['vhost_domain'] = $parsed['vhost_domain'];
			$mirror['iframe_url'] = $parsed['iframe_url'];
			
			
			$this->view->setVar('mirror', $mirror);
			$this->view->setVar('video', $video);
			$this->view->pick("mirrors/partial_add_validate");
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