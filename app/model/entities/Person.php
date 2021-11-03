<?php

namespace app\model\entities;

use app\Db;
use app\exceptions\db\DbLoadException;
use app\exceptions\db\DbSaveException;
use app\exceptions\validation\CityNotValidException;
use app\exceptions\validation\EmailNotValidException;
use app\exceptions\validation\NameNotValidException;
use app\exceptions\validation\PhoneNotValidException;
use app\exceptions\validation\StreetNotValidException;
use app\validators\person\CityPropertyValidator;
use app\validators\person\EmailPropertyValidator;
use app\validators\person\NamePropertyValidator;
use app\validators\person\PhonePropertyValidator;
use app\validators\person\StreetPropertyValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class Person
{
    private ?int $id;
    private string $name;
    private string $email;
    private string $phone;
    private string $street;
    private string $city;

    private EmailPropertyValidator $emailValidator;

    public function __construct(string $name, string $email, string $phone, string $street, string $city, int $id = null)
    {
        $this->emailValidator = new EmailPropertyValidator();
        $this->setName(trim($name));
        $this->setEmail(trim($email));
        $this->setPhone(trim($phone));
        $this->setStreet(trim($street));
        $this->setCity(trim($city));
        $this->setId($id);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @param int|null $id
     */
    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     * @throws NameNotValidException
     */
    private function setName(string $name): void
    {
        NamePropertyValidator::validate($name);
        $this->name = $name;
    }

    /**
     * @param string $email
     * @throws EmailNotValidException
     */
    private function setEmail(string $email): void
    {
        $this->emailValidator->validate($email, new RFCValidation());
        $this->email = $email;
    }

    /**
     * @param string $phone
     * @throws PhoneNotValidException
     */
    private function setPhone(string $phone): void
    {
        PhonePropertyValidator::validate($phone);
        $this->phone = $phone;
    }

    /**
     * @param string $street
     * @throws StreetNotValidException
     */
    private function setStreet(string $street): void
    {
        StreetPropertyValidator::validate($street);
        $this->street = $street;
    }

    /**
     * @param string $city
     * @throws CityNotValidException
     */
    private function setCity(string $city): void
    {
        CityPropertyValidator::validate($city);
        $this->city = $city;
    }

    /**
     * @param Db $db
     * @return bool
     * @throws DbSaveException
     */
    public function save(Db $db): bool
    {
        $db->savePerson($this);
        return true;
    }

    /**
     * @param Db $db
     * @param int $id
     * @return bool
     * @throws DbLoadException
     */
    public static function load(Db $db, int $id): bool
    {
        $db->loadPersonById($id);
        return true;
    }

}