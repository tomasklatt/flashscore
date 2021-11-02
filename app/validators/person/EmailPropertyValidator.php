<?php

namespace app\validators\person;

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
        return $this->eguliasEmailValidator->isValid($email, $emailValidation ?? new RFCValidation());
    }
}