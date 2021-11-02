<?php

namespace app\validators\person;

class PhonePropertyValidator implements PersonPropertyValidator
{
    CONST PHONE_STRING_PATTERN = '^\d{3} \d{3} \d{3}$';

    public static function isValid(string $property): bool
    {
        return boolval(preg_match('/' . self::PHONE_STRING_PATTERN . '/', $property));
    }
}