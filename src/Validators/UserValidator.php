<?php

namespace App\Validators;

use App\Table\UserTable;

class UserValidator extends AbstractValidator {
    
    public function __construct(array $data, UserTable $table, ?string $username = null)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['username', 'password']);
        $this->validator->rule('lengthBetween', ['username', 'password'], 8, 50);

        // return false if username already used
        $this->validator->rule(function($field, $value) use ($table, $username) {
            return !$table->exists($field, $value, $username);
        }, ['username'], "Ce nom d'utilisateur est déjà utilisé");
    }
}