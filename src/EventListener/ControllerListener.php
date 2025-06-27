<?php

namespace App\EventListener;

use App\Attributes\ValidatePropertiesDto;
use App\Dto\PropertiesDto;
use App\Exception\PropertiesValidationErrorsException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ErrorController;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ControllerListener
{
    public function __construct(
        protected SerializerInterface $serializer,
        protected ValidatorInterface  $validator,
    )
    {
    }

    /**
     * @throws ExceptionInterface
     * @throws PropertiesValidationErrorsException
     * @throws \ReflectionException
     */
//    #[AsEventListener(event: ControllerEvent::class,)]
    public function onKernelController(
        ControllerEvent $event,
    ): void
    {
        //TODO Здесь единая точка входа для listener-а контроллеров
        //TODO надо будет полностью его переписывать под паттерн Strategy или Factory.
        $controller = $event->getController();

        $reflection = new \ReflectionMethod(
            $controller[0],
            $controller[1]
        );

        $attributes = $reflection->getAttributes(
            ValidatePropertiesDto::class
        );

        if (empty($attributes)) {
            return;
        }

        /** @var string $requestData */
        $requestData = $event
            ->getRequest()
            ->getContent();

        $this->checkContentData(
            $requestData
        );
    }

    /**
     * @throws ExceptionInterface
     * @throws PropertiesValidationErrorsException
     */
    private function checkContentData(
        string $requestData
    ): void
    {
        /** @var PropertiesDto $propertiesDto */
        $propertiesDto = $this->serializer->deserialize(
            $requestData,
            PropertiesDto::class,
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
