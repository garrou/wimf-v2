<?php

namespace App\Table;

use App\Helpers\SessionHelper;
use App\Models\Category;
use PDO;

class CategoryTable extends Table {

    public function __construct()
    {
        parent::__construct('categories', Category::class);
    }

    public function findAll(): array 
    {
        $stmt = $this->pdo->prepare("
            SELECT categories.id, categories.name, categories.picture, COUNT(foods.id) AS total
            FROM categories
            LEFT JOIN users ON users.id = :uid
            LEFT JOIN foods ON categories.id = foods.category AND users.id = foods.uid
            GROUP BY categories.id
            ORDER BY categories.id;
        ");
        $stmt->execute(['uid' => SessionHelper::extractUserId()]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetchAll();
        return $result ? $result : [];
    }
}