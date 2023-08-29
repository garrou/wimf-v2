<?php

namespace App\Table;

use App\Models\User;
use PDO;
use Exception;

class UserTable extends Table
{

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

    public function update(User $user): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE {$this->table}
            SET username = :username, password = :password
            WHERE id = :id
        ");

        $updated = $stmt->execute([
            'id' => $_SESSION['SESSION'],
            'username' => $user->getUsername(),
            'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
        ]);

        if (!$updated) {
            throw new Exception("Impossible de modifier l'utilisateur");
        }
    }

    public function updateUsername(string $username): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE {$this->table}
            SET username = :username
            WHERE id = :id
        ");

        $updated = $stmt->execute([
            'id' => $_SESSION['SESSION'],
            'username' => $username
        ]);

        if (!$updated) {
            throw new Exception("Impossible de modifier l'utilisateur");
        }
    }

    public function updatePassword(string $password): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE {$this->table}
            SET password = :password
            WHERE id = :id
        ");

        $updated = $stmt->execute([
            'id' => $_SESSION['SESSION'],
            'password' => $password
        ]);

        if (!$updated) {
            throw new Exception("Impossible de modifier l'utilisateur");
        }
    }
}
