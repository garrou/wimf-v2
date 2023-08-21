<?php

namespace App\Table;

use App\Models\User;
use PDO;
use Exception;

class UserTable extends Table {

    private PDO $pdo;

    private string $table;

    private $class;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->table = "user";
        $this->class = User::class;
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
            'registed_at' => $user->getRegistedAt()->format('d-m-Y')
        ]);


        if ($created === false) {
            throw new Exception("Impossible de créer le post dans la table {$this->table}");
        }
        $post->setID($this->pdo->lastInsertId());
    }
}