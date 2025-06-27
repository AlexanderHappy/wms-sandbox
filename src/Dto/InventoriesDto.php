<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints;
class InventoriesDto
{
    #[Constraints\NotBlank]
    #[Constraints\Length(max: 255)]
    public string $title;

    #[Constraints\NotBlank]
    #[Constraints\Length(max: 255)]
    public string $slug;
}
