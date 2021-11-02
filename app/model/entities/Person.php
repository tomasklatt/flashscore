<?php

namespace app\model\entities;

use app\exceptions\EmailNotValidException;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class Person
{
    private string $name;
    private string $email;
    private string $phone;
    private string $street;
    private string $city;

    private EmailValidator $emailValidator;

    public function __construct(string $name, string $email, string $phone, string $street, string $city)
    {
        $this->emailValidator = new EmailValidator();
        $this->setName($name);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setStreet($street);
        $this->setCity($city);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $email
     * @throws EmailNotValidException
     */
    private function setEmail(string $email): void
    {
        if($this->emailValidator->isValid($email, new RFCValidation())){
            throw new EmailNotValidException("Email is not valid.");
        }
        $this->email = $email;
    }

    /**
     * @param string $phone
     */
    private function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param string $street
     */
    private function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @param string $city
     */
    private function setCity(string $city): void
    {
        $this->city = $city;
    }

}