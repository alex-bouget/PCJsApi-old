<?php

namespace PCJs\Core;

class Response
{
    private ?array $header;
    private string $content;

    public function __construct(string $content, array $header = null)
    {
        $this->content = $content;
        $this->header = $header;
    }

    public function getHeader(): ?array
    {
        return $this->header;
    }

    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
