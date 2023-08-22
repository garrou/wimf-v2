<?php

namespace App\Validators;

use Valitron\Validator;

abstract class AbstractValidator {

    protected array $data;

    protected Validator $validator;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->validator = new Validator($data, [], 'fr');
    }
    
    public function validate(): bool
    {
        return $this->validator->validate();
    }
    
    public function errors(): array
    {
        return $this->validator->errors();
    }
}