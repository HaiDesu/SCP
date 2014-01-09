<?php

namespace Abstaff\Models;

class ResetPasswords extends \Phalcon\Mvc\Model
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
    public $code;

    /**
     *
     * @var integer
     */
    public $createdAt;

    /**
     *
     * @var integer
     */
    public $modifiedAt;

    /**
     *
     * @var string
     */
    public $reset;
	
	/**
     *
     * Set which table model corresponds to
     */
	public function getSource()
	{
		return 'reset_passwords';
	}

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmaton
        $this->createdAt = time();

        // Generate a random confirmation code
        $this->code = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));

        // Set status to non-confirmed
        $this->reset = 'N';
    }

    /**
     * Sets the timestamp before update the confirmation
     */
    public function beforeValidationOnUpdate()
    {
        // Timestamp the confirmaton
        $this->modifiedAt = time();
    }

    /**
     * Send an e-mail to users allowing him/her to reset his/her password
     */
	 /*
    public function afterCreate()
    {
        $this->getDI()
            ->getMail()
            ->send(array(
            $this->user->email => $this->user->name
        ), "Reset your password", 'reset', array(
            'resetUrl' => '/reset-password/' . $this->code . '/' . $this->user->email
        ));
    }
	*/

    public function initialize()
    {
        $this->belongsTo('userId', 'Abstaff\Models\Users', 'id', array(
            'alias' => 'user'
        ));
    }

}