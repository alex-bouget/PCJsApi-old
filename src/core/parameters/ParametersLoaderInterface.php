<?php

namespace PCJs\Core\Parameters;

use PCJs\Core\Query;

interface ParametersLoaderInterface
{
    /**
     * Register a parameter
     * 
     * @param string $name Name of the parameter
     * @param array<ParametersType> $type Type of the parameter
     * @param object|null $value Value of the parameter
     * 
     * @return void
     */
    public function register(string $name, array $type, object $value = null): void;


    /**
     * Delete a registry
     * 
     * @param string $name Name of the registry
     * 
     * @return void
     */
    public function delete(string $name): void;

    /**
     * Load the parameters of a function
     * 
     * @param array<\ReflectionParameter> $params Parameters of the function
     * @param Query|null $q Query or null for view the need parameters
     * 
     * @return array|false
     */
    public function load_parameters(array $params, Query|null $q = null): array|false;
}