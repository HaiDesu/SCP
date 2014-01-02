<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Controller,
	Phalcon\Tag as Tag;

class ControllerBase extends Controller
{

	protected function initialize()
    {
        if (!$this->session->get('auth')) {
			$this->flashSession->error('Access Denied!');
			return $this->response->redirect('session/index');
		}
		
		Tag::prependTitle('AB Staff :: ');
		$this->view->setVar("i_user", $this->session->get('auth'));
    }

}