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

    public function invalidNameProvider(): array
    {
        return [
            ['Tomáš 5Klatt'],
            ['select * from users'],
            ['.........asdasd....']
        ];
    }

    /**
     * @dataProvider invalidNameProvider
     */
    public function testCannotBeCreatedWithInvalidName(string $invalidName): void
    {
        $this->expectException(NameNotValidException::class);

        new TestPersonBuilder(
            name: $invalidName,
            email: 'mail@tomasklatt.cz',
            phone: '724 148 490',
            street: 'Absolonova 634',
            city: 'Brno 62400'
        );
    }

    public function invalidEmailProvider(): array
    {
        return [
            ['invalid'],
            ['mail@tomasklatt'],
            ['5555442']
        ];
    }

    /**
     * @dataProvider invalidEmailProvider
     */
    public function testCannotBeCreatedWithInvalidEmailAddress(string $invalidEmail): void
    {
        $this->expectException(EmailNotValidException::class);

        new TestPersonBuilder(
            name: 'Tomáš Klatt',
            email: $invalidEmail,
            phone: '724 148 490',
            street: 'Absolonova 634',
            city: 'Brno 62400'
        );
    }

    public function invalidPhoneProvider(): array
    {
        return [
            ['invalid'],
            ['mail@tomasklatt'],
            ['5555442'],
            ['724148490'],
            ['000 000 000'],
            ['800 000 000']
        ];
    }

    /**
     * @dataProvider invalidPhoneProvider
     */
    public function testCannotBeCreatedWithInvalidPhone(string $invalidPhone): void
    {
        $this->expectException(PhoneNotValidException::class);

        new TestPersonBuilder(
            name: 'Tomáš Klatt',
            email: 'mail@tomasklatt.cz',
            phone: $invalidPhone,
            street: 'Absolonova 634',
            city: 'Brno 62400'
        );
    }

    public function invalidStreetProvider(): array
    {
        return [
            ['invalid'],
            ['mail@tomasklatt'],
            ['5555442'],
            ['724148490'],
            ['000 000 000'],
            ['Absolonova'],
            ['Absolonova ']
        ];
    }

    /**
     * @dataProvider invalidStreetProvider
     */
    public function testCannotBeCreatedWithInvalidStreet(string $invalidStreet): void
    {
        $this->expectException(StreetNotValidException::class);

        new TestPersonBuilder(
            name: 'Tomáš Klatt',
            email: 'mail@tomasklatt.cz',
            phone: '724 148 490',
            street: $invalidStreet,
            city: 'Brno 62400'
        );
    }

    public function invalidCityProvider(): array
    {
        return [
            ['invalid'],
            ['mail@tomasklatt'],
            ['5555442'],
            ['724148490'],
            ['Brno'],
            ['Brno ']
        ];
    }

    /**
     * @dataProvider invalidCityProvider
     */
    public function testCannotBeCreatedWithInvalidCity(string $invalidCity): void
    {
        $this->expectException(CityNotValidException::class);

        new TestPersonBuilder(
            name: 'Tomáš Klatt',
            email: 'mail@tomasklatt.cz',
            phone: '724 148 490',
            street: 'Absolonova 634',
            city: $invalidCity
        );
    }
}