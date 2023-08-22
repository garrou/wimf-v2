<?php

namespace App\Validators;

use App\Table\UserTable;

class UserValidator extends AbstractValidator {
    
    public function __construct(array $data) {
        parent::__construct($data);
    }

    public function userRegistration(UserTable $table, ?string $username = null): self {
        $this->validator->rule('required', ['username', 'password']);
        $this->validator->rule('lengthBetween', ['username', 'password'], 8, 50);
        $this->validator->rule('equals', ['password', 'confirm']);
        $this->validator->rule(function($field, $value) use ($table, $username) {
            return !$table->exists($field, $value, $username);
        }, ['username'], "Ce nom d'utilisateur est déjà utilisé");

        return $this;
    }
}