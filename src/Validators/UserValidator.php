<?php

namespace App\Validators;

use App\Table\UserTable;

class UserValidator {

    private array $data;

    private array $errors;
    
    public function __construct(array $data) 
    {
        $this->data = $data;
        $this->errors = array();
    }

    public function isValidRegister(UserTable $table): bool 
    {
        return $this->exists('username') && $this->validateLength('username', 3, 30)
            && $this->exists('password') && $this->validateLength('password', 8, 50)
            && $this->exists('confirm') && $this->equals('password', 'confirm')
            && !$table->exists('username', $this->getDataByKey('username'));
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function getDataByKey(string $key): mixed 
    {
        return $this->data[$key];
    }

    private function validateLength(string $field, int $min, int $max): bool
    {
        $len = strlen($this->data[$field]);
        $res = $len >= $min && $len <= $max;

        if (!$res) {
            $errors[$field] = "Longueur invalide ($min, $max)";
        } 
        return $res;
    }

    private function exists(string $field): bool
    {
        $res = isset($this->data[$field]) && !is_null($this->data[$field]);

        if (!$res) {
            $errors[$field] = "Champ inexistant";
        } 
        return $res;
    }

    private function equals(string $a, string $b): bool 
    {
        $res = $this->data[$a] === $this->data[$b];

        if (!$res) {
            $errors[$a] = "Champs différents";
        } 
        return $res;
    }
}