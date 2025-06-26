<?php

namespace App\Service;

use App\Dto\PropertiesDto;
use App\Interface\PropertiesInterface;
use Symfony\Component\DependencyInjection\Attribute\Target;

class PropertiesService
{
    public function __construct(
        #[Target('properties.repository')]
        private PropertiesInterface $propertiesService,
    )
    {
    }

    public function store(
        PropertiesDto $propertiesDto,
    ): bool
    {
        return $this->propertiesService->store(
            $propertiesDto
        );
    }
}
