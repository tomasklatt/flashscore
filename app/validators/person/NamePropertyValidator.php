<?php declare(strict_types=1);

namespace app\validators\person;


use app\exceptions\validation\NameNotValidException;

class NamePropertyValidator implements PersonPropertyValidator
{
    CONST NAME_STRING_PATTERN = '^[a-zA-Z ěščřžýáíééĚŠČŘŽÝÁÍÉ]+$';

    /**
     * @param string $propertyValue
     * @return bool
     */
    public static function isValid(string $propertyValue): bool
    {
        return boolval(preg_match('/' . self::NAME_STRING_PATTERN . '/', $propertyValue));
    }

    /**
     * @param string $propertyValue
     * @throws NameNotValidException
     */
    public static function validate(string $propertyValue): void
    {
        if(!self::isValid($propertyValue)){
            throw new NameNotValidException('Value ' . $propertyValue . ' is not valid for Name property');
        }
    }
}