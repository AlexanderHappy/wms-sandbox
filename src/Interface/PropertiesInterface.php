<?php

namespace App\Interface;

use App\Dto\PropertiesDto;

interface PropertiesInterface
{
    public function store(
        PropertiesDto $propertiesDto,
    ): bool;
}
