<?php

namespace App\EventListener;

use App\Dto\PropertiesDto;
use App\Exception\PropertiesValidationErrorsException;
use App\Validator\ByAttributesValidator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ControllerListener
{
    public function __construct(
        protected SerializerInterface $serializer,
        protected ValidatorInterface  $validator,
        #[Autowire('%kernel.project_dir%')]
        private readonly string       $projectDir,
    )
    {
    }

    /**
     * @throws ExceptionInterface
     * @throws PropertiesValidationErrorsException
     * @throws \ReflectionException
     */
    #[AsEventListener(event: ControllerEvent::class,)]
    public function onKernelController(
        ControllerEvent $event,
    ): void
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        $reflection = new \ReflectionMethod(
            $controller[0],
            $controller[1]
        );

        $attributesValidator = new ByAttributesValidator(
            $reflection
        );
        $attributesValidator->setAttributesOfValidator(
            $this->projectDir
        );

        if (empty($attributesValidator->getAttributesOfValidator())) {
            return;
        }

        /** @var string $requestData */
        $requestData = $event
            ->getRequest()
            ->getContent();

        $this->checkContentData(
            $attributesValidator,
            $requestData
        );
    }

    /**
     * @throws ExceptionInterface
     * @throws PropertiesValidationErrorsException
     */
    private function checkContentData(
        ByAttributesValidator $attributesValidator,
        string                $requestData
    ): void
    {
        $validateDtoClass = $attributesValidator
            ->getAttributesOfValidator()
            ->getName();

        $validateDtoClass = str_replace(
            'App\\Attributes\\Validate',
            'App\\Dto\\',
            $validateDtoClass
        );

        /** @var PropertiesDto $propertiesDto */
        $propertiesDto = $this->serializer->deserialize(
            $requestData,
            $validateDtoClass,
            'json'
        );

        $errors = $this->validator->validate(
            $propertiesDto
        );

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }

            throw new PropertiesValidationErrorsException(
                $errorMessages,
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
