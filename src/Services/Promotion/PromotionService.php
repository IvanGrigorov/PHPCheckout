<?php

namespace App\Services\Promotion;

use App\Entity\Product;
use App\Entity\Promotion;
use App\Models\RequestModels\ProductRequestModel;
use App\Models\RequestModels\PromotionRequestModel;
use App\Repository\ProductRepository;
use App\Repository\PromotionRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PromotionService implements IPromotionService {

    public function __construct(
        private EntityManagerInterface $entityManager,
        private PromotionRepository $promotionRepository,
        private ProductRepository $productRepository)
    {

    }

    public function create(PromotionRequestModel $promotionRequestModel) : int {
        $promotion = new Promotion();
        $promotion->setProductId($this->productRepository->findOneById($promotionRequestModel->getProductId()));
        $promotion->setAmount($promotionRequestModel->getAmount());
        $promotion->setPrice($promotionRequestModel->getPrice());
        $this->entityManager->persist($promotion);
        $this->entityManager->flush();
        return $promotion->getId();
    }

    public function update(PromotionRequestModel $promotionRequestModel) : bool {
        $promotion = $this->promotion->findOneById($promotionRequestModel->getId());
        $promotion->setProductId($this->productRepository->findOneById($promotionRequestModel->getProductId()));
        $promotion->setAmount($promotionRequestModel->getAmount());
        $promotion->setPrice($promotionRequestModel->getPrice());
        $this->entityManager->persist($promotion);
        $this->entityManager->flush();
        return true;
    }

    public function delete(int $promotionId) : bool  {
        $promotion = $this->promotionRepository->findOneById($promotionId);
        $this->entityManager->remove($promotion);
        $this->entityManager->flush();
        return true;
    }
}