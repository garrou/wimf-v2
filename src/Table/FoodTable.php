<?php

namespace App\Table;

use App\Helpers\SessionHelper;
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
            'uid' => SessionHelper::extractUserId(),
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
            'uid' => SessionHelper::extractUserId(),
        ]);

        if (!$updated) {
            throw new Exception("Impossible de modifier l'aliment");
        }
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE uid = :uid ORDER BY id DESC");
        $stmt->execute(['uid' => SessionHelper::extractUserId()]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetchAll();

        if (!$result) {
            throw new Exception("Aucune donnée trouvée dans la table {$this->table}");
        }
        return $result;
    }

    public function findAllByCid(int $cid): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE uid = :uid AND category = :category ORDER BY id DESC");
        $stmt->execute(['uid' => SessionHelper::extractUserId(), 'category' => $cid]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetchAll();
        return $result ? $result : [];
    }

    public function findById(int $id): Food
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id AND uid = :uid");
        $stmt->execute(['id' => $id, 'uid' => SessionHelper::extractUserId()]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetch();

        if (!$result) {
            throw new Exception("Aucune donnée trouvée dans la table {$this->table}");
        }
        return $result;
    }

    public function deleteById(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id AND uid = :uid");
        $deleted = $stmt->execute(['id' => $id, 'uid' => SessionHelper::extractUserId()]);

        if (!$deleted) {
            throw new Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }
    }

    public function resume(): array 
    {
        $stmt = $this->pdo->prepare("
            SELECT categories.name AS category_name, COUNT(*) AS total
            FROM foods
            JOIN categories ON foods.category = categories.id
            JOIN users ON users.id = foods.uid
            WHERE users.id = :uid
            GROUP BY categories.id
        ");
        $stmt->execute(['uid' => SessionHelper::extractUserId()]);
        $result = $stmt->fetchAll();
        return $result ? $result : [];
    }
}