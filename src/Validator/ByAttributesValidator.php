<?php

namespace App\Validator;

use ReflectionMethod;
use Symfony\Component\Finder\Finder;

class ByAttributesValidator
{
    private ReflectionMethod     $reflection;
    private \ReflectionAttribute $attributesOfValidator;

    public function __construct(
        ReflectionMethod $reflection,
    )
    {
        $this->reflection = $reflection;

        return $this;
    }

    public function getAttributesOfValidator(): \ReflectionAttribute
    {
        return $this->attributesOfValidator;
    }
    public function setAttributesOfValidator(
        string $projectDir
    ): void
    {
        $finder = new Finder();
        $finder
            ->files()
            ->name('*.php')
            ->in($projectDir . '/src/Attributes');

        foreach ($finder as $splFileInfo) {
            $class = 'App\\Attributes\\' . $splFileInfo->getBasename(
                    '.' . $splFileInfo->getExtension()
                );

            $attributes = $this->reflection->getAttributes(
                $class
            );

            if (empty($attributes)) {
                continue;
            }

            $this->attributesOfValidator = $this->reflection->getAttributes(
                $class
            )[0];
        }
    }
}
