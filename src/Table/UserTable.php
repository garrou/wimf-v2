<?php

namespace App\Table;

use App\Models\User;
use PDO;
use Exception;

class UserTable extends Table {

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, "users", User::class);
    }

    public function findByUsername(string $username): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetch();

        if (is_null($result->getId())) {
            throw new Exception("L'utilisateur n'est pas inscrit");
        }
        return $result;
    }

    public function create(User $user): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} (id, username, password)
            VALUES (:id, :username, :password)");

        $created = $stmt->execute([
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
        ]);


        if ($created === false) {
            throw new Exception("Impossible de créer l'utilisateur'");
        }
    }
}