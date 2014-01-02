<?php

namespace Abstaff\Models;

class Pages extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;
     
    /**
     *
     * @var string
     */
    public $title;
     
    /**
     *
     * @var string
     */
    public $slug;
	
	/**
     *
     * @var string
     */
    public $content;
     
}
