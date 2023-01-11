<?php

namespace pcjs\core;

use pcjs\core\tools\Config;

use function pcjs\core\tools\load_config;
use function pcjs\core\tools\load_parameters;

class PCJsApi
{
    private Config $config;

    public function __construct($config_file)
    {
        $this->config = load_config($config_file);
    }

    public function load_entry(Query $q): Response
    {
        $entry = $q->get("entry");
        if ($entry === null) {
            $entry = "PcJsApi.not_entry";
        }
        if (in_array($entry, array_keys($this->config->components)) === false) {
            $method = $this->config->components["PcJsApi.not_found"];
        } else {
            $method = $this->config->components[$entry];
        }

        if ($method === null) {
            $method = $this->config->components["PcJsApi.unknown_error"];
        }
        if ($method->isPublic() === false) {
            $method = $this->config->components["PcJsApi.not_public"];
        }
        $args = load_parameters($method->getParameters(), $this, $q);
        if ($args === false) {
            $method = $this->config->components["PcJsApi.not_parameters"];
            $args = load_parameters($method->getParameters(), $this, $q);
        }
        $response = $method->invokeArgs(new $method->class($this), $args);
        return $response;
    }

    public function get_config(): Config
    {
        return $this->config;
    }
}
