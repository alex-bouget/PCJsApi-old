<?php

namespace PCJs\Core\Parameters;

class ParametersRegistry
{
    /**
     * @var string Name of the parameter
     */
    private string $name;

    /**
     * @var array<ParametersType> Type of the parameter
     */
    private array $type;

    /**
     * @var object|null Value of the parameter
     */
    private object|null $value = null;

    public function __construct(string $name, array $type, object|null $value = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    public function get_name(): string
    {
        return $this->name;
    }

    public function get_type(): array
    {
        return $this->type;
    }

    public function get_value(): object|null
    {
        return $this->value;
    }
}
