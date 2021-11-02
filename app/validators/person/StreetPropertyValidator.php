<?php

namespace app\validators\person;

class StreetPropertyValidator implements PersonPropertyValidator
{
    CONST STREET_STRING_PATTERN = '^[a-zA-Z ]+ \d{1,5}$';

    public static function isValid(string $property): bool
    {
        return boolval(preg_match('/' . self::STREET_STRING_PATTERN . '/', $property));
    }
}