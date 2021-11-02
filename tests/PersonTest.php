<?php

use app\exceptions\CityNotValidException;
use app\exceptions\EmailNotValidException;
use app\exceptions\NameNotValidException;
use app\exceptions\PhoneNotValidException;
use app\exceptions\StreetNotValidException;
use PHPUnit\Framework\TestCase;

include('TestPersonBuilder.php');

final class PersonTest extends TestCase
{
    public function testCannotBeCreatedWithInvalidName(): void
    {
        $this->expectException(NameNotValidException::class);

        new TestPersonBuilder(
            name: 'Tomáš 5Klatt',
            email: 'mail@tomasklatt.cz',
            phone: '724 148 490',
            street: 'Absolonova 634',
            city: 'Brno 62400'
        );
    }

    public function testCannotBeCreatedWithInvalidEmailAddress(): void
    {
        $this->expectException(EmailNotValidException::class);

        new TestPersonBuilder(
            name: 'Tomáš Klatt',
            email: 'invalid',
            phone: '724 148 490',
            street: 'Absolonova 634',
            city: 'Brno 62400'
        );
    }

    public function testCannotBeCreatedWithInvalidPhone(): void
    {
        $this->expectException(PhoneNotValidException::class);

        new TestPersonBuilder(
            name: 'Tomáš Klatt',
            email: 'mail@tomasklatt.cz',
            phone: '724148490',
            street: 'Absolonova 634',
            city: 'Brno 62400'
        );
    }

    public function testCannotBeCreatedWithInvalidStreet(): void
    {
        $this->expectException(StreetNotValidException::class);

        new TestPersonBuilder(
            name: 'Tomáš Klatt',
            email: 'mail@tomasklatt.cz',
            phone: '724 148 490',
            street: 'Absolonova ',
            city: 'Brno 62400'
        );
    }

    public function testCannotBeCreatedWithInvalidCity(): void
    {
        $this->expectException(CityNotValidException::class);

        new TestPersonBuilder(
            name: 'Tomáš Klatt',
            email: 'mail@tomasklatt.cz',
            phone: '724 148 490',
            street: 'Absolonova 634',
            city: 'Brno'
        );
    }
}