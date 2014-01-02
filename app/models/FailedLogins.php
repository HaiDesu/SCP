<?php

namespace Abstaff\Models;

use Phalcon\Mvc\Model;

/**
 * FailedLogins
 *
 * This model registers failed logins attempts users have made
 */
class FailedLogins extends Model
{
	/**
	 * @var integer
	 */
	public $id;

	/**
	 * @var integer
	 */
	public $userId;

	/**
	 * @var string
	 */
	public $ipAddress;

	/**
	 * @var string
	 */
	public $userAgent;
	
	/**
	 * @var string
	 */
	public $date;
	
	/**
	 * @var integer
	 */
	public $attempted;

	public function initialize()
	{
		$this->belongsTo('userId', 'Abstaff\Models\Users', 'id', array(
			'alias' => 'user'
		));
	}

}