<?php

namespace App\Models;

class User {

    private ?string $id = null;

    private ?string $username = null;

    private ?string $password = null;

    public static function initialize(string $username, string $password): self 
    {
        $instance = new self();
        $instance->id = uniqid();
        $instance->username = $username;
        $instance->password = $password;
        return $instance;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}