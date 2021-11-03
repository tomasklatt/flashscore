<?php declare(strict_types=1);

namespace app\validators\person;

use app\exceptions\validation\CityNotValidException;

class CityPropertyValidator implements PersonPropertyValidator
{
    CONST CITY_STRING_PATTERN = '^[a-zA-Z ěščřžýáíééĚŠČŘŽÝÁÍÉ]{2,33} (?:\d{5}|\d{3} \d{2})$';

    /**
     * @param string $propertyValue
     * @return bool
     */
    public static function isValid(string $propertyValue): bool
    {
        return boolval(preg_match('/' . self::CITY_STRING_PATTERN . '/', $propertyValue));
    }

    /**
     * @param string $propertyValue
     * @throws CityNotValidException
     */
    public static function validate(string $propertyValue): void
    {
        if(!self::isValid($propertyValue)){
            throw new CityNotValidException('Value ' . $propertyValue . ' is not valid for City property');
        }
    }
}