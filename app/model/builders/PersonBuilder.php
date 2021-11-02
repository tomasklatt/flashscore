<?php

namespace app\model\builders;

use app\model\entities\Person;

interface PersonBuilder
{
    function build(): void;
    function getPerson(): ?Person;
}