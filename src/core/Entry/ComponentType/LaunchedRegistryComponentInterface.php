<?php

namespace PCJs\Core\ComponentType;

interface LaunchedRegistryComponentInterface extends RegistryComponentInterface
{
    /**
     * Interface for big registry component (launch only if used)
     * 
     * @Entry __
     */
    public function launch(): void;
}