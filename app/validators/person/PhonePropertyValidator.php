<?php

namespace app\validators\person;

use app\exceptions\validation\PhoneNotValidException;

class PhonePropertyValidator implements PersonPropertyValidator
{
    CONST PHONE_STRING_PATTERN = '^[67]{1}\d{2} \d{3} \d{3}$';

    /**
     * @param string $property
     * @return bool
     */
    public static function isValid(string $propertyValue): bool
    {
        return boolval(preg_match('/' . self::PHONE_STRING_PATTERN . '/', $propertyValue));
    }

    /**
     * @param string $propertyValue
     * @throws PhoneNotValidException
     */
    public static function validate(string $propertyValue): void
    {
        if(!self::isValid($propertyValue)){
            throw new PhoneNotValidException('Value ' . $propertyValue . ' is not valid for Phone property');
        }
    }
}