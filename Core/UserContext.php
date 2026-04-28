<?php

class UserContext
{
    public function __construct(
        public int $id,
        public string $role,
        public string $email = '',
    ) {}
}
