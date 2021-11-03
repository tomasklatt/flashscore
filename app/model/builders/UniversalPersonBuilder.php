<?php declare(strict_types=1);

namespace app\model\builders;

use app\model\entities\Person;

class UniversalPersonBuilder implements PersonBuilder
{
    private Person $person;

    private ?int $id;
    private string $name;
    private string $email;
    private string $phone;
    private string $street;
    private string $city;

    public function __construct(string $name, string $email, string $phone, string $street, string $city, int $id = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->street = $street;
        $this->city = $city;
        $this->id = $id;
        self::build();
    }

    public function build(): void
     {
         $this->person = new Person(
             name: $this->name,
             email: $this->email,
             phone: $this->phone,
             street: $this->street,
             city: $this->city,
             id: $this->id
         );
     }

     public function getPerson(): Person
     {
         return $this->person;
     }
}