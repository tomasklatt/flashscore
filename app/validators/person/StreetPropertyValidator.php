<?php

namespace app\validators\person;

use app\exceptions\validation\StreetNotValidException;

class StreetPropertyValidator implements PersonPropertyValidator
{
    CONST STREET_STRING_PATTERN = '^[a-zA-Z ěščřžýáíééĚŠČŘŽÝÁÍÉ]+ \d{1,5}$';

    /**
     * @param string $propertyValue
     * @return bool
     */
    public static function isValid(string $propertyValue): bool
    {
        return boolval(preg_match('/' . self::STREET_STRING_PATTERN . '/', $propertyValue));
    }

    /**
     * @param string $propertyValue
     * @throws StreetNotValidException
     */
    public static function validate(string $propertyValue): void
    {
        if(!self::isValid($propertyValue)){
            throw new StreetNotValidException('Value ' . $propertyValue . ' is not valid for Street property');
        }
    }
}