<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints;

class InventoriesDto
{
    #[Constraints\NotBlank(
        message: 'Title should not be blank'
    )]
    #[Constraints\Length(
        max: 255,
        maxMessage: 'Title should not be longer than 255 characters'
    )]
    public string $title;

    #[Constraints\NotBlank(
        message: 'Slug should not be blank',
    )]
    #[Constraints\Length(
        max: 255,
        maxMessage: 'Slug should not be longer than 255 characters'
    )]
    public string $slug;
}
