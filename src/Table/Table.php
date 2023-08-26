<?php

namespace App\Table;

use PDO;
use Exception;

abstract class Table {

    protected PDO $pdo;

    protected string $table;

    protected mixed $class;

    public function __construct(PDO $pdo, string $table, string $class)
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->class = $class;
    }

    public function find(mixed $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetch();

        if (!$result) {
            throw new Exception("Aucune donnée trouvée dans la table {$this->table}");
        }
        return $result;
    }

    public function exists(string $field, mixed $value, mixed $except = null): bool
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE $field = ?";
        $params = [$value];

        if ($except !== null) {
            $sql .= " AND id != ?";
            $params[] = $except;
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetch(PDO::FETCH_NUM)[0] > 0;
    }

    public function delete(mixed $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $deleted = $stmt->execute([$id]);

        if (!$deleted) {
            throw new Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }
    }

    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }
}