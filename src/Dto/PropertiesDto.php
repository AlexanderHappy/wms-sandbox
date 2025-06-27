<?php

namespace App\Dto;

use App\Validator\Constraints as CustomConstraints;
use Symfony\Component\Validator\Constraints;
class PropertiesDto
{
    #[Constraints\NotBlank]
    #[Constraints\Length(max: 255)]
    #[CustomConstraints\UniqueTitleProperty]
    public string $title;

    #[Constraints\NotBlank]
    #[Constraints\Length(max: 255)]
    #[CustomConstraints\UniqueSlugProperty]
    public string $slug;

    #[Constraints\NotBlank]
    #[Constraints\Type('integer')]
    #[CustomConstraints\PropertyTypeExists]
    public int $type;
}
