<?php

namespace App\Controller;

use App\Services\Buying\IBuyingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuyingController extends AbstractController
{
    #[Route('/buying', name: 'buying', methods:['POST'])]
    public function buy(Request $request, 
                        IBuyingService $buyingService): Response
    {
        $products = $request->request->get('products');
        $response = $buyingService->buy($products);
        return $this->json([
            'message' => 'The checkout is successfull!',
            'info' => $response,
        ], Response::HTTP_OK);
    }
}
