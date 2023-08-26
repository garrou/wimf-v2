<?php

namespace App\Models;

class Category {

    private ?int $id = null;

    private ?string $name = null;

    private ?string $picture = null;

    public function getId(): ?int 
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
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

    public function getPicture(): ?string 
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }
}