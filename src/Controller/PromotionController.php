<?php

namespace App\Controller;

use App\Models\RequestModels\PromotionRequestModel;
use App\Services\Promotion\PromotionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    #[Route('/promotion/create', name: 'create_promotion', methods:["POST"])]
    public function create(Request $request, PromotionService $promotionService): Response
    {

        $newPromotionId = $promotionService->create(new PromotionRequestModel(
                $request->request->get('productId'),
                $request->request->get('amount'),
                $request->request->get('price')
        ));
        return $this->json([
            'message' => 'New Promotion created!',
            'id' => $newPromotionId,
        ], Response::HTTP_CREATED);
    }

    #[Route('/promotion/update', name: 'update_promotion', methods:["PUT"])]
    public function update(Request $request, PromotionService $promotionService): Response
    {

        $promotionService->update(new PromotionRequestModel(
            $request->request->get('productId'),
            $request->request->get('amount'),
            $request->request->get('price'),
            $request->request->get('id')
        ));
        return $this->json([
            'message' => 'Promotion Updated!'
        ], Response::HTTP_OK);
    }

    #[Route('/promotion/delete/{id}', name: 'delete_promotion', methods:["DELETE"])]
    public function delete(int $id, PromotionService $promotionService): Response
    {
        $promotionService->delete($id);
        return $this->json([
            'message' => 'New Promotion deleted!',
        ], RESPONSE::HTTP_CREATED);
    }
}
