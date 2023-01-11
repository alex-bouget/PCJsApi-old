<?php

namespace pcjs\core;

use function pcjs\core\tools\read_need_parameters;

/**
 * @Entry PcJsApi
 */
class RootComponents
{
    /**
     * @Entry get_config
     */
    public function get_config(PCJsApi $pc) {
        return new Response(json_encode(array(
            $pc->get_config()
        )));
    }

    /**
     * @Entry get_components
     */
    public function get_components(PCJsApi $pc) {
        $data = $pc->get_config()->components;
        $components = array();
        foreach ($data as $key => $method) {
            $args = read_need_parameters($method->getParameters());
            $components[$key] = $args;

        }
        return new Response(json_encode(
            $components
        ));
    }
}

return new RootComponents();