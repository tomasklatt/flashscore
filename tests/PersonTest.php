<?php

use app\exceptions\CityNotValidException;
use app\exceptions\EmailNotValidException;
use app\exceptions\NameNotValidException;
use app\exceptions\PhoneNotValidException;
use app\exceptions\StreetNotValidException;
use app\model\entities\Person;
use PHPUnit\Framework\TestCase;

include('TestPersonBuilder.php');

final class PersonTest extends TestCase
{
    public function successfulCreateProvider(): array
    {
        return [
            ['Tomáš Klatt', 'mail@tomasklatt.cz', '724 148 490', 'Absolonova 634', 'Brno 62400'],
            ['Eric Theodore Cartman', 'cartman@comedycentral.com', '605 123 456', 'Londýnské náměstí 1', 'Brno 639 00'],
        ];
    }

    /**
     * @dataProvider successfulCreateProvider
     */
    public function testCanBeCreatedWithValidData(
        string $name,
        string $email,
        string $phone,
        string $street,
        string $city
    ): void {
        $this->assertInstanceOf(
            Person::class,
            (new TestPersonBuilder(
                name: $name,
                email: $email,
                phone: $phone,
                street: $street,
                city: $city
            ))->getPerson()
        );
    }

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
            phone: '000 000 000',
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