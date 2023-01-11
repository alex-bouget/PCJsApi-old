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
        $method = $this->config->components[$entry];

        $args = load_parameters($method->getParameters(), $this, $q);
        $response = $method->invokeArgs(new $method->class($this), $args);
        return $response;
    }

    public function get_config(): Config
    {
        return $this->config;
    }
}
