<?php

namespace PCJs\Components;

use PCJs\Core\Response;

/**
 * @Entry exemple1
 */
class Exemple
{
    /**
     * @Entry exemple1
     */
    public function exemple1(int $nb): Response
    {
        return new Response(json_encode(array(
            "Exemple 1",
            $nb + 1,
        )));
    }
}
