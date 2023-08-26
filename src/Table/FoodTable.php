<?php

namespace App\Table;

use App\Models\Food;
use Exception;
use PDO;

class FoodTable extends Table {

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, 'foods', Food::class);
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
            throw new Exception("Impossible de créer l'utilisateur");
        }
    }
}