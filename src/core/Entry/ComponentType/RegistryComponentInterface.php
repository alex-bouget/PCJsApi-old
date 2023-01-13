<?php

namespace PCJs\Core\ComponentType;

use PCJs\Core\Parameters\ParametersLoaderInterface;

interface RegistryComponentInterface extends EntryComponentInterface
{
    /**
     * Interface for all Registry Components (Entry Components is can be used in the RegistryComponent)
     * 
     * @Entry __
     */
    public function register(ParametersLoaderInterface $pli): void;
}