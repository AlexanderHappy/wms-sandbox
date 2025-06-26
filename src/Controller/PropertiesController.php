<?php

namespace App\Controller;

use App\Dto\PropertiesDto;
use App\Entity\Properties;
use App\Interface\PropertiesInterface;
use App\Service\PropertiesService;
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
    #[Route('/properties/store', name: 'properties', methods: ['POST'])]
    public function store(
        Request             $request,
        SerializerInterface $serializer,
        PropertiesService   $propertiesService
    ): JsonResponse
    {
        $properties = $serializer->deserialize(
            $request->getContent(),
            PropertiesDto::class,
            'json'
        );

        $propertiesService->store(
            $properties
        );

        return $this->json(
            [
                'message' => 'Welcome to your new controller!',
                'path'    => 'src/Controller/PropertiesController.php',
            ]
        );
    }
}
