<?php

use app\exceptions\EmailNotValidException;
use PHPUnit\Framework\TestCase;

final class PersonTest extends TestCase
{
    public function testCannotBeCreatedFromInvalidEmailAddress(): void
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
}