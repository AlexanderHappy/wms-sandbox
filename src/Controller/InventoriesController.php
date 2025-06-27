<?php

namespace App\Controller;

use App\Attributes\ValidateInventoriesDto;
use App\Dto\InventoriesDto;
use App\Factory\PropertiesFactory;
use App\Factory\PropertyTypeFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class InventoriesController extends AbstractController
{
    #[Route('/inventories/store', name: 'inventories', methods: 'POST')]
    #[ValidateInventoriesDto]
    public function index(
        Request             $request,
        SerializerInterface $serializer,
    ): JsonResponse
    {
        /** @var InventoriesDto $inventoriesDto */
        $inventoriesDto = $serializer->deserialize(
            $request->getContent(),
            InventoriesDto::class,
            'json'
        );

        return $this->json(
            [
                'message' => 'Inventories has been created successfully.',
            ]
        );
    }
}
