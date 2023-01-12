<?php

use pcjs\core\PCJsApi;
use pcjs\core\Response;

/**
 * @Entry exemple1
 */
class Exemple
{
    /**
     * @Entry exemple1
     */
    public function exemple1(PCJsApi $api, int $nb): Response
    {
        return new Response(json_encode(array(
            "Exemple 1",
            $nb + 1,
        )));
    }
}

return new Exemple();
