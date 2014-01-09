<?php

namespace Abstaff\Models;

class Videohosts extends \Phalcon\Mvc\Model
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
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'videohosts';
	}
	
	/**
     *
     * Specify relationships
     */
	public function initialize()
	{
		$this->hasMany('id', 'Abstaff\Models\Mirrors', 'vhost');
	}
     
}