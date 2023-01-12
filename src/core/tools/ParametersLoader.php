<?php

namespace pcjs\core\tools;
use pcjs\core\PCJsApi;
use pcjs\core\Query;

function read_need_parameters(array $params): array
{
    $need = array();
    foreach ($params as $parameter) {
        switch ($parameter->getType()) {
            case "pcjs\core\Query":
            case "pcjs\core\PCJsApi":
                break;
            default:
                $need[$parameter->getName()] = $parameter->getType()->__toString();
                break;
        }
    }
    return $need;
}


function load_parameters(array $params, PCJsApi $pc, Query $q): array|false
{
    $args = array();
    foreach ($params as $parameter) {
        $data = "";
        switch ($parameter->getType()) {
            case "pcjs\core\Query":
                $data = $q;
                break;
            case "pcjs\core\PCJsApi":
                $data = $pc;
                break;

            case "?int":
                if ($q->post($parameter->getName()) === null) {
                    $data = null;
                    break;
                }
            case "int":
                if ($q->post($parameter->getName()) === null) {
                    return false;
                }
                $data = intval($q->post($parameter->getName()));
                break;
            case "?float":
                if ($q->post($parameter->getName()) === null) {
                    $data = null;
                    break;
                }
            case "float":
                if ($q->post($parameter->getName()) === null) {
                    return false;
                }
                $data = floatval($q->post($parameter->getName()));
                break;
            case "?string":
                if ($q->post($parameter->getName()) === null) {
                    $data = null;
                    break;
                }
            case "string":
                if ($q->post($parameter->getName()) === null) {
                    return false;
                }
                $data = $q->post($parameter->getName());
                break;
            default:
                return false;
                break;
        }
        $args[] = $data;
    }
    return $args;
}
