<?php

namespace App\Table;

use App\Models\User;
use PDO;
use Exception;

class UserTable extends Table {

    public function __construct()
    {
        parent::__construct('users', User::class);
    }

    public function findByUsername(string $username): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetch();

        if (!$result) {
            throw new Exception("L'utilisateur n'est pas inscrit");
        }
        return $result;
    }

    public function create(User $user): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} (id, username, password)
            VALUES (:id, :username, :password)
        ");

        $created = $stmt->execute([
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
        ]);

        if (!$created) {
            throw new Exception("Impossible de créer l'utilisateur");
        }
    }

    public function update(User $user, string $id): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE {$this->table}
            SET username = :username, password = :password
            WHERE id = :id
        ");

        $updated = $stmt->execute([
            'id' => $id,
            'username' => $user->getUsername(),
            'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
        ]);

        if (!$updated) {
            throw new Exception("Impossible de créer l'utilisateur");
        }
    }
}