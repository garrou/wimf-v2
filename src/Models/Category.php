<?php

namespace App\Models;

class Category {

    private ?int $id = null;

    private ?string $name = null;

    private ?string $picture = null;

    private ?int $total = null;

    public function getId(): ?int 
    {
        return $this->id;
    }
    
    public function getName(): ?string 
    {
        return $this->name;
    }

    public function getPicture(): ?string 
    {
        return $this->picture;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }
}