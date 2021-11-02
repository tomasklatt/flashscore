<?php

use app\model\builders\PersonBuilder;
use app\model\entities\Person;

class TestPersonBuilder implements PersonBuilder
{
    private Person $person;

    private string $name;
    private string $email;
    private string $phone;
    private string $street;
    private string $city;

    public function __construct(string $name, string $email, string $phone, string $street, string $city)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->street = $street;
        $this->city = $city;
        self::build();
    }

    public function build(): void
     {
         $this->person = new Person(
             name: $this->name,
             email: $this->email,
             phone: $this->phone,
             street: $this->street,
             city: $this->city
         );
     }

     public function getPerson(): Person
     {
         return $this->person;
     }
}