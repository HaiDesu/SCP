<?php

namespace Abstaff\Models;

class SeriesGenres extends \Phalcon\Mvc\Model
{

	/**
     *
     * @var integer
     */
    public $seriesId;
	
	/**
     *
     * @var integer
     */
    public $genresId;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'series_genres';
	}
	
	/**
     *
     * Specify relationships
     */
	public function initialize()
	{
		$this->belongsTo('seriesId', 'Abstaff\Models\Series', 'id');
		$this->belongsTo('genresId', 'Abstaff\Models\Genres', 'id');
	}

}