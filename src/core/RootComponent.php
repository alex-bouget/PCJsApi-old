<?php

namespace PCJs\Components;

use PCJs\Core\ComponentType\EntryComponentInterface;
use PCJs\Core\Entry\EntryLoader;
use PCJs\Core\Parameters\ParametersLoader;
use PCJs\Core\Response;

/**
 * @Entry PcJsApi
 */
class RootComponents implements EntryComponentInterface
{

    /**
     * @Entry get_components
     */
    public function get_components(EntryLoader $el)
    {
        $components = $el->get_components();
        $to_json = array();
        foreach ($components as $component) {
            $to_json[$component->get_name()] = array(
                "name" => $component->get_name(),
                "parameters" => $component->get_parameters(),
                "entries" => array_keys($component->get_entries()),
            );
        }
        return new Response(json_encode(
            $to_json,
        ));
    }

    /**
     * @Entry get_entries
     */
    public function get_entries(EntryLoader $el, ParametersLoader $pl)
    {
        $entries = array();
        foreach ($el->get_components() as $component) {
            $entries = array_merge($entries, $component->get_entries());
        }
        $to_json = array();
        foreach ($entries as $entry) {
            $params = $pl->load_parameters($entry->get_method()->getParameters());
            $to_json[$entry->get_name()] = $params;
        }
        return new Response(json_encode(
            $to_json,
        ));
    }


    // Error entries

    private $check = "Please check the entries [PcJsApi.get_entries]";
    private $contact = "Please contact the administrator";

    /**
     * @Entry __not_found
     */
    public function not_found()
    {
        return new Response(json_encode(array(
            "error" => "The entry isn't existed. ". $this->check
        )));
    }

    /**
     * @Entry __not_entry
     */
    public function not_entry()
    {
        return new Response(json_encode(array(
            "error" => "The entry is not send. " . $this->check
        )));
    }

    /**
     * @Entry __not_public
     */
    public function not_public()
    {
        return new Response(json_encode(array(
            "error" => "The entry is not public. " . $this->contact
        )));
    }

    /**
     * @Entry __not_parameters
     */
    public function not_parameters()
    {
        return new Response(json_encode(array(
            "error" => "You don't send all parameters or a parameter is not good. " . $this->check
        )));
    }

    /**
     * @Entry __unknown_error
     */
    public function unknown_error()
    {
        return new Response(json_encode(array(
            "error" => "An unknown error occurred. " . $this->contact
        )));
    }
}
