<?php

namespace Abstaff\Models;

class MirrorTypes extends \Phalcon\Mvc\Model
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
    public $name;
	
	/**
     *
     * @var string
     */
    public $shortcode;
     
    /**
     *
     * @var string
     */
    public $description;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'mirror_types';
	}
	
	/**
     *
     * Specify relationships
     */
	public function initialize()
	{
		//$this->hasMany('id', 'Abstaff\Models\Mirrors', 'type');
	}
     
}