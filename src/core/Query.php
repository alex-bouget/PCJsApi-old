<?php


namespace PCJs\Core;

class Query {
    private array $get;
    private array $post;

    public function __construct(array $get, array $post)
    {
        $this->get = $get;
        $this->post = $post;
    }

    public function get(string $key): ?string
    {
        if (!isset($this->get[$key])) {
            return null;
        }
        return $this->get[$key];
    }

    public function post(string $key): ?string
    {
        if (!isset($this->post[$key])) {
            return null;
        }
        return $this->post[$key];
    }

    public function get_all(): array
    {
        return $this->get;
    }

    public function post_all(): array
    {
        return $this->post;
    }
}