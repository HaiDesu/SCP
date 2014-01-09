<?php

namespace Abstaff\Models;

class Articles extends \Phalcon\Mvc\Model
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
	
	/**
     *
     * @var string
     */
    public $isPublished;
	
	/**
     *
     * @var integer
     */
    public $author;
	
	/**
     *
     * @var integer
     */
    public $views;
	
	/**
     *
     * @var datetime
     */
    public $createdOn;
	
	/**
     *
     * @var int
     */
    public $category;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'articles';
	}
	
	
	public function initialize()
    {
        $this->belongsTo("category", "ArticlesCategory", "id");
        $this->belongsTo("author", "Users", "id");
    }
     
}
