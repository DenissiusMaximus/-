<?php

namespace Models;

class Source
{
    public function __construct(
        public int $user_id,
        public string $name,
        public float $balance = 0.00,
        public ?int $id = null
    ) {}
}
