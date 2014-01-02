<?php

namespace Abstaff\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

	protected function initialize()
    {
        Tag::prependTitle('Staff | ');
    }

}