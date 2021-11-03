<?php

namespace app\validators\person;

use app\exceptions\validation\EmailNotValidException;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\EmailValidation;
use Egulias\EmailValidator\Validation\RFCValidation;

class EmailPropertyValidator
{
    private EmailValidator $eguliasEmailValidator;

    public function __construct()
    {
        $this->eguliasEmailValidator = new EmailValidator();
    }

    public function isValid(string $email, EmailValidation|RFCValidation $emailValidation = null): bool
    {
        //the Egulias email validator check mail@tomasklatt as valid, so I added filter bellow
        return filter_var($email, FILTER_VALIDATE_EMAIL) && $this->eguliasEmailValidator->isValid($email, $emailValidation ?? new RFCValidation());
    }

    /**
     * @param string $propertyValue
     * @param EmailValidation|RFCValidation|null $emailValidation
     * @throws EmailNotValidException
     */
    public function validate(string $propertyValue, EmailValidation|RFCValidation $emailValidation = null): void
    {
        if(!$this->isValid($propertyValue, $emailValidation)){
            throw new EmailNotValidException('Value ' . $propertyValue . ' is not valid for Email property');
        }
    }
}