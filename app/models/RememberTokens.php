<?php

namespace Abstaff\Models;

class RememberTokens extends \Phalcon\Mvc\Model
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
    public $userId;
	
	/**
     *
     * @var string
     */
    public $token;
	
	/**
     *
     * @var string
     */
    public $userAgent;
	
	/**
     *
     * @var integer
     */
    public $ceatedAt;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'remember_tokens';
	}

}