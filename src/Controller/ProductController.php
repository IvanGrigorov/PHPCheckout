<?php

namespace App\Controller;

use App\Infrastructure\ResponseMessages;
use App\Models\RequestModels\ProductRequestModel;
use App\Services\Product\ProductService;
use Exception;
use RMValidator\Options\OptionsModel;
use RMValidator\Validators\MasterValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/create', name: 'create_product', methods:["POST"])]
    public function create(Request $request, ProductService $productService): Response
    {

        $productModel = new ProductRequestModel(
            $request->request->get('name'),
            $request->request->get('price')
        );
        try {
            MasterValidator::validate($productModel, new OptionsModel()); 
        }
        catch(Exception $e) {
            return $this->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
        $newProductId = $productService->create($productModel);
        return $this->json([
            'message' => ResponseMessages::NEW_PRODUCT,
            'id' => $newProductId,
        ], Response::HTTP_CREATED);
    }

    #[Route('/product/update', name: 'update_product', methods:["PUT"])]
    public function update(Request $request, ProductService $productService): Response
    {

        $productModel = new ProductRequestModel(
            $request->request->get('name'),
            $request->request->get('price'),
            $request->request->get('id'),
        );
        try {
            MasterValidator::validate($productModel, new OptionsModel()); 
        }
        catch(Exception $e) {
            return $this->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
        $productService->update($productModel);
        return $this->json([
            'message' => ResponseMessages::UPDATE_PRODUCT
        ], Response::HTTP_OK);
    }

    #[Route('/product/delete/{id}', name: 'delete_product', methods:["DELETE"])]
    public function delete(int $id, ProductService $productService): Response
    {
        try {
            $productService->delete($id);
        }
        catch(Exception $e) {
            return $this->json([
                'message' => ResponseMessages::DELETE_PROBLEM
            ], RESPONSE::HTTP_BAD_REQUEST);
        }
        return $this->json([
            'message' => ResponseMessages::DELETE_PRODUCT
        ], RESPONSE::HTTP_OK);
    }
}
