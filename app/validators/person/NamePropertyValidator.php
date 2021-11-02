<?php

namespace app\validators\person;


class NamePropertyValidator implements PersonPropertyValidator
{
    public static function isValid(string $property): bool
    {
        return true;
    }
}