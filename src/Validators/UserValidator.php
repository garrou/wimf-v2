<?php

namespace App\Validators;

use App\Table\UserTable;

class UserValidator extends Validator {

    const MIN_PASSWORD = 3;

    const MAX_PASSWORD = 50;

    const MIN_USERNAME = 3;

    const MAX_USERNAME = 30;

    public function __construct(array $data) 
    {
        parent::__construct($data);
    }

    public function isValidRegister(UserTable $table): bool 
    {
        return $this->exists('username') && $this->validateLength('username', self::MIN_USERNAME, self::MAX_USERNAME)
            && $this->exists('password') && $this->validateLength('password', self::MIN_PASSWORD, self::MAX_PASSWORD)
            && $this->exists('confirm') && $this->equals('password', 'confirm')
            && !$table->exists('username', $this->getDataByKey('username'));
    }

    public function isValidUpdate(UserTable $table): bool 
    {
        if ($this->isValidRegister($table)) {
            return true;
        } else if ($this->exists('username')) {
            return $this->validateLength('username', self::MIN_USERNAME, self::MAX_USERNAME) &&  !$table->exists('username', $this->getDataByKey('username'));
        } else if ($this->exists('password') && $this->exists('confirm')) {
            return $this->validateLength('password', self::MIN_PASSWORD, self::MAX_PASSWORD) && $this->equals('password', 'confirm');
        }
        return false;
    }
}