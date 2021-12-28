<?php declare(strict_types=1);

namespace app\model\builders;

use app\model\entities\Person;

class BruceWayneBuilder implements PersonBuilder
{
    private Person $person;

    public function __construct()
    {
        self::build();
    }

    final function build(): void
     {
         $this->person = new Person(
             name: "Bruce Wayne",
             email: "bruce@wayne.com",
             phone: "604 123 456",
             street: "Mountain Drive 1007",
             city: "Gotham 53705"
         );
     }

     public function getPerson(): Person
     {
         return $this->person;
     }
}