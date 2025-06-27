<?php

namespace App\Validator\Constraints;

use App\Entity\Properties;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueSlugPropertyValidator extends ConstraintValidator
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    public function validate(
        mixed      $value,
        Constraint $constraint
    ): void
    {
        if (!$constraint instanceof UniqueSlugProperty) {
            throw new UnexpectedTypeException(
                $constraint,
                UniqueSlugProperty::class
            );
        }

        $existingSlug = $this->entityManager
            ->getRepository(Properties::class)
            ->findOneBy(
                [
                    'slug' => $value,
                ]
            );

        if ($existingSlug) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
