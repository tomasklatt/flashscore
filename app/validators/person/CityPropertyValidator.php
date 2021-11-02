<?php

namespace app\validators\person;

class CityPropertyValidator implements PersonPropertyValidator
{
    CONST CITY_STRING_PATTERN = '^[a-zA-Z ěščřžýáíééĚŠČŘŽÝÁÍÉ]{2,33} (?:\d{5}|\d{3} \d{2})$';

    public static function isValid(string $property): bool
    {
        return boolval(preg_match('/' . self::CITY_STRING_PATTERN . '/', $property));
    }
}