<?php

namespace PCJs\Core\Entry;

class Entry implements LoadedEntityInterface
{
    /**
     * @var string $name
     */
    private string $name;


    /**
     * @var array<string, string> $parameters
     */
    private array $parameters;

    /**
     * @var \ReflectionMethod $method
     */
    private \ReflectionMethod $method;


    public function __construct(string $class_name, \ReflectionMethod $method)
    {
        $this->method = $method;
        $this->parameters = get_all_parameters($method);
        if (!isset($this->parameters['Entry'])) {
            $this->name = "__not_entry__";
        }
        $this->name = $class_name . '.' . $this->parameters['Entry'];
    }

    /**
     * Get the name of the entry
     * 
     * @return string
     */
    public function get_name(): string
    {
        return $this->name;
    }

    /**
     * Get the method of the entry
     * 
     * @return \ReflectionMethod
     */
    public function get_method(): \ReflectionMethod
    {
        return $this->method;
    }

    /**
     * Get the parameters of the entry
     * 
     * @return array<string, string>
     */
    public function get_parameters(): array
    {
        return $this->parameters;
    }
}
