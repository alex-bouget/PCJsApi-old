<?php

namespace PCJs\Core\Parameters;

use PCJs\Core\Query;

class ParametersLoader implements ParametersLoaderInterface
{
    /**
     * Register of the parameters
     * 
     * @var array<string, ParametersRegistry>
     */
    private array $parameters_registry;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parameters_registry = array();
        $this->register("int", array(ParametersType::INT));
        $this->register("string", array(ParametersType::STRING));
        $this->register("bool", array(ParametersType::BOOL));
        $this->register("float", array(ParametersType::FLOAT));
        $this->register("?int", array(ParametersType::INT, ParametersType::NULL));
        $this->register("?string", array(ParametersType::STRING, ParametersType::NULL));
        $this->register("?bool", array(ParametersType::BOOL, ParametersType::NULL));
        $this->register("?float", array(ParametersType::FLOAT, ParametersType::NULL));
    }

    /**
     * Register a parameter
     * 
     * @param string $name Name of the parameter
     * @param array<ParametersType> $type Type of the parameter
     * @param object|null $value Value of the parameter
     * 
     * @return void
     */
    public function register(string $name, array $type, object $value = null): void
    {
        $this->parameters_registry[$name] = new ParametersRegistry($name, $type, $value);
    }

    /**
     * Delete a registry
     * 
     * @param string $name Name of the registry
     * 
     * @return void
     */
    public function delete(string $name): void
    {
        unset($this->parameters_registry[$name]);
    }


    /**
     * Load the parameters of a function
     * 
     * @param array<\ReflectionParameter> $params Parameters of the function
     * @param Query|null $q Query or null for view the need parameters
     * 
     * @return array|false
     */
    public function load_parameters(array $params, Query|null $q = null): array|false
    {
        $args = array();
        foreach ($params as $parameter) {
            if (isset($this->parameters_registry[$parameter->getType()->getName()])) {
                $registry = $this->parameters_registry[$parameter->getType()->getName()];
                if (in_array(ParametersType::AUTOMATIZED, $registry->get_type())) {
                    if ($q === null) {
                        continue;
                    }
                    $args[] = $registry->get_value();
                } else {
                    if ($q === null) {
                        $args[] = $registry->get_name();
                        continue;
                    }
                    if ($q->post($parameter->getName()) === null) {
                        if (in_array(ParametersType::NULL, $registry["type"])) {
                            $args[] = null;
                            continue;
                        }
                        return false;
                    }
                    $args[] = $q->post($parameter->getName());
                }
            } else {
                return false;
            }
        }
        return $args;
    }
}
