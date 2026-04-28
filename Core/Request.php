<?php

namespace Core;

use UserContext;

class Request
{
    public ?UserContext $user = null;

    public function __construct(
        public readonly string $method,
        public readonly string $uri,
        public readonly array $getParams,
        public readonly array $postData
    ) {}

    public function setUserContext(UserContext $user): void
    {
        $this->user = $user;
    }

    public function post(string $key, $default = null)
    {
        return $this->postData[$key] ?? $default;
    }

    public function get(string $key, $default = null)
    {
        return $this->getParams[$key] ?? $default;
    }

    public function getJson(): ?array
    {
        $input = file_get_contents('php://input');
        return json_decode($input, true);
    }
}
