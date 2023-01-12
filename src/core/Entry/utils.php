<?php

namespace PCJs\Core\Entry;

/**
 * get all parameter in the documentation
 * 
 * @param object $object a Reflection object with doc
 * 
 * @return array<string, string> the parameters
 */
function get_all_parameters(object $object): array
{
    $get_pointer = $object->getDocComment();
    $last_arobase_pos = 0;
    $parameters = array();
    while (($last_arobase_pos = strpos($get_pointer, '@', $last_arobase_pos + 1)) !== false) {
        $futur_arobase_pos = strpos($get_pointer, '@', $last_arobase_pos + 1);
        if ($futur_arobase_pos === false) {
            $futur_arobase_pos = strlen($get_pointer);
        }
        $param = substr($get_pointer, $last_arobase_pos + 1, $futur_arobase_pos - $last_arobase_pos);
        $key = explode(' ', $param)[0];
        $value = explode(' ', $param)[1];
        $key = trim($key);
        $value = trim($value);
        $parameters[$key] = $value;
    }
    return $parameters;
}



/**
 * Get all the classes in a namespace
 */
function classes_in_namespace($namespace)
{
    $namespace .= '\\';
    $myClasses  = array_filter(get_declared_classes(), function ($item) use ($namespace) {
        return substr($item, 0, strlen($namespace)) === $namespace;
    });
    $theClasses = [];
    foreach ($myClasses as $class) :
        $theParts = explode('\\', $class);
        $theClasses[] = end($theParts);
    endforeach;
    return $theClasses;
}
