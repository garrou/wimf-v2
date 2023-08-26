<?php

namespace App\Validators;

use App\Table\UserTable;

class UserValidator extends Validator {

    public function __construct(array $data) 
    {
        parent::__construct($data);
    }

    public function isValidRegister(UserTable $table): bool 
    {
        return $this->exists('username') && $this->validateLength('username', 3, 30)
            && $this->exists('password') && $this->validateLength('password', 8, 50)
            && $this->exists('confirm') && $this->equals('password', 'confirm')
            && !$table->exists('username', $this->getDataByKey('username'));
    }
}