<?php

namespace App\Validator\Constraints;

use App\Entity\Properties;
use App\Entity\PropertyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueTitlePropertyValidator extends ConstraintValidator
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
        if (!$constraint instanceof UniqueTitleProperty) {
            throw new UnexpectedTypeException(
                $constraint,
                UniqueTitleProperty::class
            );
        }

        $existingTitle = $this->entityManager
            ->getRepository(Properties::class)
            ->findOneBy(
                [
                    'title' => $value,
                ]
            );

        if ($existingTitle) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
