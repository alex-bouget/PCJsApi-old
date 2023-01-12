<?php


namespace pcjs\core\tools;

class Config
{
    public array $components;
}

function get_pointer($object): string
{
    $get_pointer = $object->getDocComment();
    $get_pointer = explode("\n", explode('@Entry ', $get_pointer)[1])[0];
    $get_pointer = trim($get_pointer);
    return $get_pointer;
}

function get_component(string $path): array
{
    $class_components = (include $path);
    $rc = new \ReflectionClass(get_class($class_components));
    $components = array();

    $pointer_class = get_pointer($rc);
    foreach ($rc->getMethods() as $method) {
        $pointer_method = get_pointer($method);
        if ($pointer_method == "") {
            continue;
        }
        $components[$pointer_class . "." . $pointer_method] = $method;
    }
    return $components;
}

function load_config(string $config_file): Config
{
    $config_data = json_decode(file_get_contents($config_file), true);
    $config = new Config();
    if (isset($config_data['components_dir'])) {
        $dir = realpath(".") . "/" . $config_data['components_dir'];
        $components = get_component("core/RootComponent.php");
        foreach (scandir($dir) as $file) {
            if (is_file($dir . "/" . $file)) {
                $all_components = get_component($dir . "/" . $file);
                $components = array_merge($components, $all_components);
            }
        }
        $config->components = $components;
    }

    return $config;
}
