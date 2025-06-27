<?php

namespace App\Controller;

use App\Factory\PropertiesFactory;
use App\Factory\PropertyTypeFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class InventoriesController extends AbstractController
{
    #[Route('/inventories', name: 'app_inventories', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json(
            [
                'message' => 'Welcome to your new controller!',
            ]
        );
    }
}
