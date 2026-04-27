<?php

namespace Models;

class User
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password_hash,
        public string $role = 'user',
        public ?int $id = null
    ) {}
}
