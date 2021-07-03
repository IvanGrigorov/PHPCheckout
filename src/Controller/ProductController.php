<?php

namespace App\Controller;

use App\Models\RequestModels\ProductRequestModel;
use App\Services\Product\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/create', name: 'create_product', methods:["POST"])]
    public function create(Request $request, ProductService $productService): Response
    {

        $product = $request->request->get('product');
        $newProductId = $productService->create(new ProductRequestModel(
            $request->request->get('name'),
            $request->request->get('price')

        ));
        return $this->json([
            'message' => 'New Product created!',
            'id' => $newProductId,
        ], Response::HTTP_CREATED);
    }

    #[Route('/product/update', name: 'update_product', methods:["PUT"])]
    public function update(Request $request, ProductService $productService): Response
    {

        $product = $request->request->get('product');
        $productService->update(new ProductRequestModel(
                $request->request->get('name'),
                $request->request->get('price'),
                $request->request->get('id'),
        ));
        return $this->json([
            'message' => 'Product Updated!'
        ], Response::HTTP_OK);
    }

    #[Route('/product/delete/{id}', name: 'delete_product', methods:["DELETE"])]
    public function delete(int $id, ProductService $productService): Response
    {

        $productService->delete($id);
        return $this->json([
            'message' => 'New Product deleted!',
        ], RESPONSE::HTTP_CREATED);
    }
}
