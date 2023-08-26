<?php

namespace App\Table;

use App\Models\Category;
use PDO;

class CategoryTable extends Table {

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, 'categories', Category::class);
    }
}