<?php

namespace App\Models;

class Food {

    private ?int $id = null;

    private ?string $name = null;

    private ?int $quantity = null;

    private ?string $details = null;

    private ?int $category = null;

    private ?string $uid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(int $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }
}