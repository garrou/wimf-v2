<?php

namespace App\Table;

use App\Models\User;
use PDO;
use Exception;

class UserTable extends Table {

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, "user", User::class);
    }

    public function findByUsername(string $username) 
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} where username = :username");
        $stmt->execute(['username' => $username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetch();

        if ($result === false) {
            throw new Exception("L'utilisateur n'est pas inscrit");
        }
        return $result;
    }

    public function create(User $user): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} 
            SET username = :username, password = :password");

        $created = $stmt->execute([
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'registed_at' => $user->getRegistedAt(),
        ]);


        if ($created === false) {
            throw new Exception("Impossible de créer l'utilisateur'");
        }
    }
}