<?php

namespace Abstaff\Models;

use Phalcon\Mvc\Model\Validator\Email as EmailValidator,
	Phalcon\Mvc\Model\Validator\StringLength as StringLengthValidator,
	Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Users extends \Phalcon\Mvc\Model
{

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $salt;

    /**
     * @var date
     */
    public $regDate;
	
	public function validation()
    {
        $this->validate(new EmailValidator(array(
            'field' => 'email'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'email',
            'message' => 'Sorry, The email was registered by another user'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'username',
            'message' => 'Sorry, That username is already taken'
        )));
		$this->validate(new StringLengthValidator(array(
            'field' => 'password',
            'min' => '8',
            'messageMinimum' => 'Password must be minimum 8 characters'
		)));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Method to set the value of field id
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Method to set the value of field username
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
	
	/**
     * Method to set the value of field email
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
	
	/**
     * Method to set the value of field password
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
	
	/**
     * Method to set the value of field salt
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
	
	/**
     * Method to set the value of field password
     * @param string $password
     */
    public function setRegdate($regDate)
    {
        $this->regDate = $regDate;
    }
	
	/**
     * Method to set the value of field validated
     * @param integer $validated
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }

    /**
     * Returns the value of field id
     * @return integer
     */
    public function getId()
    {
        return $this->status;
    }
	
	public function initialize()
	{

		$this->hasMany('id', 'Abstaff\Models\SuccessLogins', 'userId', array(
			'alias' => 'successLogins',
			'foreignKey' => array(
				'message' => 'User cannot be deleted because he/she has activity in the system'
			)
		));

	}

}