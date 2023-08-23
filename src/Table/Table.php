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
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} where id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetch();

        if (is_null($result->getId())) {
            throw new Exception("Aucune donnée trouvée");
        }
        return $result;
    }

    public function exists(string $field, mixed $value, mixed $except): bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} WHERE $field = ?";
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

        if ($deleted === false) {
            throw new Exception("Impossible de supprimer l'enregistrement $id");
        }
    }

    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }
}