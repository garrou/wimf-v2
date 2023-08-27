<?php

namespace App\Table;

use App\Models\Category;

class CategoryTable extends Table {

    public function __construct()
    {
        parent::__construct('categories', Category::class);
    }
}