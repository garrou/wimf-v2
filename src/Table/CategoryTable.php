<?php

namespace App\Table;

use App\Helpers\SessionHelper;
use App\Models\Category;

class CategoryTable extends Table {

    public function __construct()
    {
        parent::__construct('categories', Category::class);
    }

    public function findAll(): array 
    {
        $stmt = $this->pdo->prepare("
            SELECT categories.id AS id, categories.name, categories.picture, COUNT(*) AS total
            FROM categories
            JOIN foods ON categories.id = foods.category
            JOIN users ON users.id = foods.uid
            WHERE users.id = :uid
            GROUP BY categories.id
        ");
        $stmt->execute(['uid' => SessionHelper::extractUserId()]);
        $result = $stmt->fetchAll();
        return $result ? $result : [];
    }
}