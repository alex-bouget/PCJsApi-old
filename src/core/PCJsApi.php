<?php

namespace PCJs\Core;

use PCJs\Core\Entry\EntryLoader;
use PCJs\Core\Parameters\ParametersLoader;
use PCJs\Core\Parameters\ParametersLoaderInterface;
use PCJs\Core\Parameters\ParametersType;

class PCJsApi
{

    /**
     * @var EntryLoader $entry_loader
     */
    private EntryLoader $entry_loader;

    /**
     * @var ParametersLoader $parameters_loader
     */
    private ParametersLoaderInterface $parameters_loader;


    /**
     * Constructor
     * 
     * @param string $config_file Path of the config file
     */
    public function __construct()
    {
        $this->parameters_loader = new ParametersLoader();
        $this->entry_loader = new EntryLoader();
        $this->parameters_loader->register($this->parameters_loader::class, array(ParametersType::AUTOMATIZED), $this->parameters_loader);
        $this->parameters_loader->register($this->entry_loader::class, array(ParametersType::AUTOMATIZED), $this->entry_loader);
        foreach ($this->entry_loader->get_components() as $component) {
            if (in_array("PCJs\Core\ComponentType\RegistryComponentInterface", $component->get_class()->getInterfaceNames())) {
                $method = $component->get_class()->getMethod("register");
                $method->invoke($this->parameters_loader);
            }
        }
    }

    /**
     * Load the entry
     * 
     * @param Query $q Query
     * 
     * @return Response
     */
    public function load_entry(Query $q): Response
    {
        $error = $this->from_config("error_entries");
        $entry = $q->get("entry");
        if ($entry === null) {
            $entry =  $error["no_entry"];
        }
        $method = $this->entry_loader->get_entry($entry);
        if ($method === false) {
            $method = $this->entry_loader->get_entry($error["not_found"]);
        }
        if ($method === null) {
            $method = $this->entry_loader->get_entry($error["unknown_error"]);
        }
        if ($method->get_method()->isPublic() === false) {
            $method = $this->entry_loader->get_entry($error["not_public"]);
        }
        $method = $method->get_method();

        $this->parameters_loader->register($q::class, array(ParametersType::AUTOMATIZED), $q);

        $args = $this->parameters_loader->load_parameters($method->getParameters(), $q);

        if ($args === false) {
            $method = $this->entry_loader->get_entry($error["no_parameters"])->get_method();
            $args = $this->parameters_loader->load_parameters($method->getParameters(), $q);
        }

        $response = $method->invokeArgs(new $method->class($this), $args);

        $this->parameters_loader->delete($q::class);

        return $response;
    }

    public function get_parameters_loader(): ParametersLoader
    {
        return $this->parameters_loader;
    }

    public function from_config(string $entry): mixed
    {
        global $config_json;
        if (isset($config_json[$entry])) {
            return $config_json[$entry];
        }
        return null;
    }
}
