<?php

namespace app\validators\person;

use Egulias\EmailValidator\Validation\EmailValidation;
use Egulias\EmailValidator\Validation\RFCValidation;

class EmailPropertyValidator
{
    private \Egulias\EmailValidator\EmailValidator $eguliasEmailValidator;

    public function __construct()
    {
        $this->eguliasEmailValidator = new \Egulias\EmailValidator\EmailValidator();
    }

    public function isValid(string $email, EmailValidation|RFCValidation $emailValidation = null): bool
    {
        return $this->eguliasEmailValidator->isValid($email, $emailValidation ?? new RFCValidation());
    }
}