<?php

namespace App\Validators;

use App\Table\CategoryTable;

class FoodValidator extends Validator {

    public function __construct(array $data) 
    {
        parent::__construct($data);
    }

    public function isValidFood(CategoryTable $table): bool 
    {
        return $this->exists('name') && $this->validateLength('name', 1, 255)
            && $this->exists('quantity') && $this->validateBetween('quantity', 1, PHP_INT_MAX)
            && $this->exists('details') && $this->validateLength('details', 0, 1000)
            && $this->exists('category') && $table->exists('id', $this->getDataByKey('category'));
    }
}