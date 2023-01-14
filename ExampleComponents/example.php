<?php

namespace PCJs\Components;

use PCJs\Core\ComponentType\EntryComponentInterface;
use PCJs\Core\Parameters\ParametersLoaderInterface;
use PCJs\Core\Response;

/**
 * @Entry exemple1
 */
class Exemple implements EntryComponentInterface
{
    /**
     * @Entry exemple1
     */
    public function exemple1(ParametersLoaderInterface $pli): Response
    {
        return new Response(json_encode(array(
            "Exemple 1",
        )));
    }
}
