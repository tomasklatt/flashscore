<?php

namespace app\validators\person;

class PhonePropertyValidator implements PersonPropertyValidator
{
    public static function isValid(string $property): bool
    {
        return true;
    }
}