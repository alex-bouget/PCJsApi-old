<?php

namespace PCJs\Core\Entry;

interface LoadedEntityInterface
{
    /**
     * Get the name of the entry
     * 
     * @return string
     */
    public function get_name(): string;

    /**
     * Get the parameters of the entry
     * 
     * @return array
     */
    public function get_parameters(): array;
}