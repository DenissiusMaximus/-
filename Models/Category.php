<?php

namespace Models;

class Category
{
    public function __construct(
        public string $name,
        public string $type, 
        public ?int $id = null
    ) {}
}
