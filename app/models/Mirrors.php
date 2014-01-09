<?php

namespace Abstaff\Models;

class Mirrors extends \Phalcon\Mvc\Model
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
    public $episode_id;
	
	/**
     *
     * @var integer
     */
    public $vhost;
    
    /**
     *
     * @var string
     */
    public $vhost_uid;
	
	/**
     *
     * @var string
     */
    public $screencap;
	
	/**
     *
     * @var integer
     */
    public $user;
	
	/**
     *
     * @var datetime
     */
    public $dateAdded;
	
	/**
     *
     * @var string
     */
    public $isApproved;
	
	/**
     *
     * @var int
     */
    public $approvedBy;
	
	/**
     *
     * @var datetime
     */
    public $dateApproved;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'mirrors';
	}
	
	
	public function initialize()
    {
        $this->belongsTo("episode_id", "Abstaff\Models\Episodes", "id");
        $this->belongsTo("vhost", "Abstaff\Models\Videohosts", "id");
        $this->belongsTo("user", "Abstaff\Models\Users", "id");
        $this->belongsTo("approvedBy", "Abstaff\Models\Users", "id");
    }
    
	public function getEpisode($parameters=null)
    {
        return $this->getRelated('Abstaff\Models\Episodes');
    }
	
	public function getVhost($parameters=null)
    {
        return $this->getRelated('Abstaff\Models\Videohosts');
    }
	
	public function getUser($parameters=null)
    {
        return $this->getRelated('Abstaff\Models\Users');
    }
	
	public function getApprovedby($parameters=null)
    {
        return $this->getRelated('Abstaff\Models\Users');
    }
}
