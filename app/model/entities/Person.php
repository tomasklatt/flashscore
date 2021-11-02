<?php

namespace app\model\entities;

use app\exceptions\CityNotValidException;
use app\exceptions\EmailNotValidException;
use app\exceptions\NameNotValidException;
use app\exceptions\PhoneNotValidException;
use app\exceptions\StreetNotValidException;
use app\validators\person\CityPropertyValidator;
use app\validators\person\EmailPropertyValidator;
use app\validators\person\NamePropertyValidator;
use app\validators\person\PhonePropertyValidator;
use app\validators\person\StreetPropertyValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class Person
{
    private string $name;
    private string $email;
    private string $phone;
    private string $street;
    private string $city;

    private EmailPropertyValidator $emailValidator;

    public function __construct(string $name, string $email, string $phone, string $street, string $city)
    {
        $this->emailValidator = new EmailPropertyValidator();
        $this->setName(trim($name));
        $this->setEmail(trim($email));
        $this->setPhone(trim($phone));
        $this->setStreet(trim($street));
        $this->setCity(trim($city));
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
     * @throws NameNotValidException
     */
    private function setName(string $name): void
    {
        if(!NamePropertyValidator::isValid($name)){
            throw new NameNotValidException("Name is not valid.");
        }
        $this->name = $name;
    }

    /**
     * @param string $email
     * @throws EmailNotValidException
     */
    private function setEmail(string $email): void
    {
        if(!$this->emailValidator->isValid($email, new RFCValidation())){
            throw new EmailNotValidException("Email is not valid.");
        }
        $this->email = $email;
    }

    /**
     * @param string $phone
     * @throws PhoneNotValidException
     */
    private function setPhone(string $phone): void
    {
        if(!PhonePropertyValidator::isValid($phone)){
            throw new PhoneNotValidException("Phone is not valid.");
        }
        $this->phone = $phone;
    }

    /**
     * @param string $street
     * @throws StreetNotValidException
     */
    private function setStreet(string $street): void
    {
        if(!StreetPropertyValidator::isValid($street)){
            throw new StreetNotValidException("Phone is not valid.");
        }
        $this->street = $street;
    }

    /**
     * @param string $city
     * @throws CityNotValidException
     */
    private function setCity(string $city): void
    {
        if(!CityPropertyValidator::isValid($city)){
            throw new CityNotValidException("Phone is not valid.");
        }
        $this->city = $city;
    }

}