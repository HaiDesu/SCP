<?php

namespace Abstaff\Models;

use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class UserGroups extends \Phalcon\Mvc\Model
{

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

	
	public function validation()
    {
        $this->validate(new UniquenessValidator(array(
            'field' => 'name',
            'message' => 'Sorry, That group already exists.'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }


}