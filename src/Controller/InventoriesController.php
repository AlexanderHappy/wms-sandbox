<?php

namespace App\Controller;

use App\Dto\InventoriesDto;
use App\Validator\Attributes\ValidateInventoriesDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class InventoriesController extends AbstractController
{
    #[Route('/inventories/store', name: 'inventories', methods: 'POST')]
    #[ValidateInventoriesDto]
    public function store(
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
