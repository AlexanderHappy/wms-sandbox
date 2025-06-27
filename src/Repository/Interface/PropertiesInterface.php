<?php

namespace App\Repository\Interface;

use App\Dto\PropertiesDto;

interface PropertiesInterface
{
    public function store(
        PropertiesDto $propertiesDto,
    ): bool;
}
