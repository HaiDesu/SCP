<?php

namespace Abstaff\Models;

class ArticleCategories extends \Phalcon\Mvc\Model
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
        $this->hasMany("id", "Articles", "category");
    }
     
}