<?php


include_once __DIR__ . "/parameters/ParametersLoaderInterface.php";
include_once __DIR__ . "/parameters/ParametersLoader.php";
include_once __DIR__ . "/parameters/ParametersRegistry.php";
include_once __DIR__ . "/parameters/ParametersType.php";

include_once __DIR__ . "/Entry/ComponentType/EntryComponentInterface.php";
include_once __DIR__ . "/Entry/ComponentType/RegistryComponentInterface.php";

include_once __DIR__ . "/Entry/LoadedEntityInterface.php";
include_once __DIR__ . "/Entry/EntryLoader.php";
include_once __DIR__ . "/Entry/Components.php";
include_once __DIR__ . "/Entry/Entry.php";
include_once __DIR__ . "/Entry/utils.php";

include_once __DIR__ . "/tools/Config.php";

include_once __DIR__ . "/PCJsApi.php";
include_once __DIR__ . "/Query.php";
include_once __DIR__ . "/Response.php";
$config_json = json_decode(file_get_contents("pcjs_config.json"), true);

/*if (in_array($config_json['version'], )) {
    throw new Exception("Invalid config version");
}*/

// Load components
include_once __DIR__ . "/RootComponent.php";

$components_dir = $config_json['components_dir'];
$components_dir = realpath(".") . "/" . $components_dir;
foreach (scandir($components_dir) as $file) {
    if (is_file($components_dir . "/" . $file)) {
        include_once $components_dir . "/" . $file;
    }
}
