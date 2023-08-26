<?php

namespace App\Validators;

abstract class Validator {

    protected array $data;

    protected array $errors;

    public function __construct(array $data) 
    {
        $this->data = $data;
        $this->errors = [];
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    protected function getDataByKey(string $key): mixed 
    {
        return $this->data[$key];
    }

    protected function validateLength(string $field, int $min, int $max): bool
    {
        $len = strlen($this->data[$field]);
        $res = $len >= $min && $len <= $max;

        if (!$res) {
            $errors[$field] = "Longueur invalide ($min, $max)";
        } 
        return $res;
    }

    protected function validateBetween(string $field, int $min, int $max): bool
    {
        $num = intval($this->data[$field]);

        if ($num === 0) {
            $errors[$field] = "Champ invalide";
            return false;
        }
        $res = $num >= $min && $num <= $max;

        if (!$res) {
            $errors[$field] = "Longueur invalide ($min, $max)";
        } 
        return $res;
    }

    protected function exists(string $field): bool
    {
        $res = isset($this->data[$field]) && !is_null($this->data[$field]);

        if (!$res) {
            $errors[$field] = "Champ inexistant";
        } 
        return $res;
    }

    protected function equals(string $a, string $b): bool 
    {
        $res = $this->data[$a] === $this->data[$b];

        if (!$res) {
            $errors[$a] = "Champs différents";
        } 
        return $res;
    }
}