<?php

namespace app\validators\person;

interface PersonPropertyValidator
{
    public static function isValid(string $property): bool;
}