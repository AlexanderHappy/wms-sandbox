<?php

namespace App\Controller;

use App\Attributes\ValidatePropertiesDto;
use App\Dto\PropertiesDto;
use App\Service\PropertiesService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class PropertiesController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route(path: '/properties/store', name: 'properties', methods: ['POST'])]
    #[ValidatePropertiesDto]
    public function store(
        LoggerInterface     $loggerInterface,
        Request             $request,
        SerializerInterface $serializer,
        PropertiesService   $propertiesService,
    ): JsonResponse
    {
        $loggerInterface->info(
            "Get request for store new Property.",
            json_decode(
                $request->getContent(),
                true
            ),
        );

        /** @var PropertiesDto $propertiesDto */
        $propertiesDto = $serializer->deserialize(
            $request->getContent(),
            PropertiesDto::class,
            'json'
        );

        $propertiesService->store(
            $propertiesDto
        );

        return $this->json(
            [
                'message' => 'Property has been stored successfully!',
            ]
        );
    }
}
