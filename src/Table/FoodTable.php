<?php

namespace App\Table;

use App\Models\Food;
use Exception;
use PDO;

class FoodTable extends Table {

    public function __construct()
    {
        parent::__construct('foods', Food::class);
    }

    public function create(Food $food): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} (name, quantity, details, category, uid)
            VALUES (:name, :quantity, :details, :category, :uid)
        ");

        $created = $stmt->execute([
            'name' => $food->getName(),
            'quantity' => $food->getQuantity(),
            'details' => $food->getDetails(),
            'category' => $food->getCategory(),
            'uid' => $_SESSION['SESSION'],
        ]);

        if (!$created) {
            throw new Exception("Impossible d'ajouter un aliment'");
        }
    }

    public function update(Food $food): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE {$this->table} 
            SET name = :name, quantity = :quantity, details = :details, category = :category
            WHERE id = :id AND uid = :uid
        ");

        $updated = $stmt->execute([
            'id' => $food->getId(),
            'name' => $food->getName(),
            'quantity' => $food->getQuantity(),
            'details' => $food->getDetails(),
            'category' => $food->getCategory(),
            'uid' => $_SESSION['SESSION'],
        ]);

        if (!$updated) {
            throw new Exception("Impossible de modifier l'aliment");
        }
    }

    public function findByCategory(int $cid): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE category = ?");
        $stmt->execute([$cid]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetchAll();
        return $result ? $result : [];
    }
}