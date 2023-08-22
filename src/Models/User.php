<?php

namespace App\Models;

class User {

    private ?string $id;

    private ?string $username;

    private ?string $password;

    private ?string $registedAt;

    public function __construct()
    {
        $this->id = null;
        $this->username = null;
        $this->password = null;
        $this->registedAt = null;
    }

    public static function initialize(string $username, string $password): self {
        $instance = new self();
        $instance->id = uniqid();
        $instance->username = $username;
        $instance->password = $password;
        $instance->registedAt = date('Y-m-d');
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

    public function getRegistedAt(): ?string
    {
        return $this->registedAt;
    }
}