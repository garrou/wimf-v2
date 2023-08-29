<?php

namespace App\Dto;

use App\Models\User;

class UserAuth {

    private ?string $username;

    private ?string $password;

    private ?string $confirm;

    public function __construct()
    {
        $this->username = null;
        $this->password = null;
        $this->confirm = null;
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

    public function getConfirm(): ?string
    {
        return $this->confirm;
    }

    public function setConfirm(string $confirm): self
    {
        $this->confirm = $confirm;
        return $this;
    }
    
    public function toUser(): User {
        return User::initialize($this->username, $this->password);
    }
}