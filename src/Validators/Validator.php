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
            $this->errors[$field] = "Longueur invalide ($min, $max)";
            return false;
        } 
        return $res;
    }

    protected function validateBetween(string $field, int $min, int $max): bool
    {
        $num = intval($this->data[$field]);

        if ($num === 0) {
            $this->errors[$field] = "Valeur invalide";
            return false;
        }
        $res = $num >= $min && $num <= $max;

        if (!$res) {
            $this->errors[$field] = "Longueur invalide ($min, $max)";
            return false;
        } 
        return $res;
    }

    protected function exists(string $field): bool
    {
        $res = isset($this->data[$field]) && !empty($this->data[$field]);

        if (!$res) {
            $this->errors[$field] = "Valeur invalide";
            return false;
        } 
        return $res;
    }

    protected function equals(string $a, string $b): bool 
    {
        $res = $this->data[$a] === $this->data[$b];

        if (!$res) {
            $this->errors[$a] = "Valeurs différentes";
            $this->errors[$b] = "Valeurs différentes";
            return false;
        } 
        return $res;
    }
}