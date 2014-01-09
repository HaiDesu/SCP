<?php

namespace Abstaff\Models;

class Episodes extends \Phalcon\Mvc\Model
{

	/**
     *
     * @var integer
     */
    public $id;
	
	/**
     *
     * @var integer
     */
    public $series_id;
	
	/**
     *
     * @var decimal
     */
    public $number;
	
	/**
     *
     * @var string
     */
    public $title;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'episodes';
	}
	
	/**
     *
     * Specify relationships
     */
	public function initialize()
	{
		$this->belongsTo('series_id', 'Abstaff\Models\Series', 'id');
	}

}