<?php

namespace Abstaff\Models;

class SeriesPresequel extends \Phalcon\Mvc\Model
{

	/**
     *
     * @var integer
     */
    public $prequel_id;
	
	/**
     *
     * @var integer
     */
    public $sequel_id;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'series_presequel';
	}
	
	/**
     *
     * Specify relationships
     */
	public function initialize()
	{
		$this->belongsTo('prequel_id', 'Abstaff\Models\Series', 'id');
		$this->belongsTo('sequel_id', 'Abstaff\Models\Series', 'id');
	}

}