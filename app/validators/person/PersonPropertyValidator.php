<?php

namespace app\validators\person;

interface PersonPropertyValidator
{
    public static function isValid(string $propertyValue): bool;
    public static function validate(string $propertyValue): void;
}