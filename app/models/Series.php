<?php

namespace Abstaff\Models;

use Phalcon\Mvc\Model\Query,
	Phalcon\Mvc\Model\Manager;
	
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Series extends \Phalcon\Mvc\Model
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
    public $altTitle;
	
	/**
     *
     * @var string
     */
    public $slug;
	
	/**
     *
     * @var int
     */
    public $type;
	
	/**
     *
     * @var string
     */
    public $status;
	
	/**
     *
     * @var int
     */
    public $episodes;
	
	/**
     *
     * @var string
     */
    public $synopsis;
	
	/**
     *
     * @var string
     */
    public $poster;
	
	/**
     *
     * @var datetime
     */
    public $dateAdded;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'series';
	}
	
	/**
     *
     * Specify relationships
     */
	public function initialize()
	{
		$this->belongsTo('type', 'Abstaff\Models\SeriesTypes', 'id');
		$this->hasMany('id', 'Abstaff\Models\Episodes', 'series_id');
		$this->hasMany('id', 'Abstaff\Models\SeriesGenres', 'seriesId');
		$this->hasMany('id', 'Abstaff\Models\SeriesPresequel', 'prequel_id');
		$this->hasMany('id', 'Abstaff\Models\SeriesPresequel', 'sequel_id');
		$this->hasManyToMany('id', 'Abstaff\Models\SeriesGenres', 'seriesId', 'genresId', 'Genres', 'id');
	}
	
	public function getType($parameters=null)
    {
        return $this->getRelated('Abstaff\Models\SeriesTypes');
    }
	
	public function getEpisodes()
	{
		return $this->getRelated('Abstaff\Models\Episodes');
	}
	
	public static function getPrequel($series_id)
	{
		$prequel = \Abstaff\Models\SeriesPresequel::findFirst(array('sequel_id = ?0', 'bind' => array($series_id)));
		$prequel = \Abstaff\Models\Series::findFirstByid($prequel->prequel_id);
		return $prequel;
	}
	
	public static function getSequel($series_id)
	{
		$sequel = \Abstaff\Models\SeriesPresequel::findFirst(array('prequel_id = ?0', 'bind' => array($series_id)));
		$sequel = \Abstaff\Models\Series::findFirstByid($sequel->sequel_id);
		return $sequel;
	}
	
	public function getGenres($series_id)
	{
		
		//return $this->getRelated('\Abstaff\Models\Genres');
	}

}