<?php

namespace Models;

class Aim
{
    public function __construct(
        public int $user_id,
        public string $name,
        public float $target_amount,
        public float $current_amount = 0.00,
        public ?int $id = null
    ) {}
}
