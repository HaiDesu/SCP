<?php

namespace Abstaff\Models;

class SeriesTypes extends \Phalcon\Mvc\Model
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
    public $description;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'series_types';
	}
	
	/**
     *
     * Specify relationships
     */
	public function initialize()
	{
		$this->hasMany('id', 'Abstaff\Models\Series', 'type');
	}
     
}