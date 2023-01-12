<?php

namespace PCJs\Core\Parameters;

enum ParametersType
{
    case INT;
    case FLOAT;
    case STRING;
    case BOOL;
    case NULL;
    case AUTOMATIZED;
}