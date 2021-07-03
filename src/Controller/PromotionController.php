<?php

namespace App\Controller;

use App\Infrastructure\ResponseMessages;
use App\Models\RequestModels\PromotionRequestModel;
use App\Services\Promotion\PromotionService;
use Exception;
use RMValidator\Options\OptionsModel;
use RMValidator\Validators\MasterValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    #[Route('/promotion/create', name: 'create_promotion', methods:["POST"])]
    public function create(Request $request, PromotionService $promotionService): Response
    {

        $promotionModel = new PromotionRequestModel(
            $request->request->get('productId'),
            $request->request->get('amount'),
            $request->request->get('price')
        );
        try {
            MasterValidator::validate($promotionModel, new OptionsModel()); 
        }
        catch(Exception $e) {
            return $this->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        $newPromotionId = $promotionService->create($promotionModel);
        return $this->json([
            'message' => ResponseMessages::NEW_PROMOTION,
            'id' => $newPromotionId,
        ], Response::HTTP_CREATED);
    }

    #[Route('/promotion/update', name: 'update_promotion', methods:["PUT"])]
    public function update(Request $request, PromotionService $promotionService): Response
    {

        $promotionModel = new PromotionRequestModel(
            $request->request->get('productId'),
            $request->request->get('amount'),
            $request->request->get('price'),
            $request->request->get('id')
        );
        try {
            MasterValidator::validate($promotionModel, new OptionsModel()); 
        }
        catch(Exception $e) {
            return $this->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        $promotionService->update($promotionModel);
        return $this->json([
            'message' => ResponseMessages::UPDATE_PROMOTION
        ], Response::HTTP_OK);
    }

    #[Route('/promotion/delete/{id}', name: 'delete_promotion', methods:["DELETE"])]
    public function delete(int $id, PromotionService $promotionService): Response
    {
        try {
            $promotionService->delete($id);
        }
        catch(Exception $e) {
            return $this->json([
                'message' => ResponseMessages::DELETE_PROBLEM
            ], RESPONSE::HTTP_BAD_REQUEST);
        }
        return $this->json([
            'message' => ResponseMessages::DELETE_PROMOTION
        ], RESPONSE::HTTP_CREATED);
    }
}
