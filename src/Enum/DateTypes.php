<?php

namespace Jadgray\FullTimeApi\Enum;

enum DateTypes: string
{
    case DATE = 'd/m/Y';
    case TIME = 'H:i';
    case FULL_TIME_DATE = 'd/m/y H:i';
}
