<?php

namespace App\Services\Product;

use App\Entity\Product;
use App\Models\RequestModels\ProductRequestModel;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

final class ProductService implements IProductService {

    public function __construct(
        private EntityManagerInterface $entityManager,
        private ProductRepository $productRepository)
    {

    }

    public function create(ProductRequestModel $productRequestModel) : int {
        $product = new Product();
        $product->setName($productRequestModel->getName());
        $product->setPrice($productRequestModel->getPrice());
        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return $product->getId();
    }

    public function update(ProductRequestModel $productRequestModel) : bool {
        $product = $this->productRepository->findOneById($productRequestModel->getId());
        $product->setName($productRequestModel->getName());
        $product->setPrice($productRequestModel->getPrice());
        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return true;
    }

    public function delete(int $productId) : bool  {
        $product = $this->productRepository->findOneById($productId);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
        return true;
    }
}