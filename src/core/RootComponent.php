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

    /**
     * @Entry not_found
     */
    public function not_found() {
        return new Response(json_encode(array(
            "error" => "The entry isn't existed. Please check the components [PcJsApi.get_components]"
        )));
    }
    
    /**
     * @Entry not_entry
     */
    public function not_entry() {
        return new Response(json_encode(array(
            "error" => "The entry is not send. Please check the components [PcJsApi.get_components]"
        )));
    }

    /**
     * @Entry not_public
     */
    public function not_public() {
        return new Response(json_encode(array(
            "error" => "The entry is not public. Contact the administrator"
        )));
    }

    /**
     * @Entry not_parameters
     */
    public function not_parameters() {
        return new Response(json_encode(array(
            "error" => "You don't send all parameters or a parameter is not good. Please check the components [PcJsApi.get_components]"
        )));
    }

    /**
     * @Entry unknown_error
     */
    public function unknown_error() {
        return new Response(json_encode(array(
            "error" => "An unknown error occurred. Please contact the administrator"
        )));
    }
}

return new RootComponents();