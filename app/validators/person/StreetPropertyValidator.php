<?php

namespace app\validators\person;

class StreetPropertyValidator implements PersonPropertyValidator
{
    public static function isValid(string $property): bool
    {
        return true;
    }
}