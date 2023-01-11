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


function load_parameters(array $params, PCJsApi $pc, Query $q): array
{
    foreach ($params as $parameter) {
        $data = "";
        switch ($parameter->getType()) {
            case "pcjs\core\Query":
                $data = $q;
                break;
            case "pcjs\core\PCJsApi":
                $data = $pc;
                break;
            case "int":
                $data = intval($q->get($parameter->getName()));
                break;
            case "float":
                $data = floatval($q->get($parameter->getName()));
                break;
            default:
                $data = $q->post($parameter->getName());
                break;
        }
        $args[] = $data;
    }
    return $args;
}
