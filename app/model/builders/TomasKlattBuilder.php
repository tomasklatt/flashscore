<?php declare(strict_types=1);

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
         $this->person = new Person(
             name: "Tomáš Klatt",
             email: "mail@tomasklatt.cz",
             phone: "724 148 490",
             street: "Absolonova 634",
             city: "Brno 62400"
         );
     }

     public function getPerson(): ?Person
     {
         return $this->person;
     }
}