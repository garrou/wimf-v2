<?php

namespace App\Validators;

use App\Table\CategoryTable;

class FoodValidator extends Validator {

    const MIN_NAME = 1;

    const MAX_NAME = 255;

    const MIN_DETAILS = 0;

    const MAX_DETAILS = 1000;

    public function __construct(array $data) 
    {
        parent::__construct($data);
    }

    public function isValidFood(CategoryTable $table): bool 
    {
        return $this->exists('name') && $this->validateLength('name', self::MIN_NAME, self::MAX_NAME)
            && $this->exists('quantity') && $this->validateBetween('quantity', 1, PHP_INT_MAX)
            && $this->exists('details') && $this->validateLength('details', self::MIN_DETAILS, self::MAX_DETAILS)
            && $this->exists('category') && $table->exists('id', $this->getDataByKey('category'));
    }
}