<?php

namespace Abstaff\Controllers;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
		//$identity = $this->session->get('auth-identity');
		$this->view->setVar("user23", $this->session->get('auth'));
    }
	
}

