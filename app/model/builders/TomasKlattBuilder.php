<?php

namespace app\model\builders;

use app\model\entities\Person;

class TomasKlattBuilder implements PersonBuilder
{
    private Person $person;

    public function __construct()
    {
        self::build();
    }

    public function build(): void
     {
         $this->person = new Person();
     }

     public function getPerson(): ?Person
     {
         return $this->person;
     }
}