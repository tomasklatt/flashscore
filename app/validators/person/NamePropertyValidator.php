<?php

namespace app\validators\person;


class NamePropertyValidator implements PersonPropertyValidator
{
    CONST NAME_STRING_PATTERN = '^[a-zA-Z ěščřžýáíééĚŠČŘŽÝÁÍÉ]+$';

    public static function isValid(string $property): bool
    {
        return boolval(preg_match('/' . self::NAME_STRING_PATTERN . '/', $property));
    }
}