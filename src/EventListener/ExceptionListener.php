<?php

namespace App\EventListener;

use App\Exception\PropertiesValidationErrorsException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    #[AsEventListener(event: ExceptionEvent::class)]
    public function onKernelException(ExceptionEvent $event): void
    {
        /** @var PropertiesValidationErrorsException $exception */
        $exception = $event->getThrowable();

        if ($exception instanceof PropertiesValidationErrorsException) {
            $response = new JsonResponse(
                [
                    'Property errors' => $exception->getErrors(),
                ]
            );

            $event->setResponse($response);
        }
    }
}
