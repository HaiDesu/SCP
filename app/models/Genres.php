<?php

namespace Abstaff\Models;

class Genres extends \Phalcon\Mvc\Model
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
	
	public function initialize()
    {
        $this->hasMany("id", "SeriesGenres", "genresId");
    }
	
	public function getSeriesGenres($parameters=null)
	{
		return $this->getRelated('Abstaff\Models\SeriesGenres');
	} 
}