<?php 

namespace App\Models\RequestModels;

final class PromotionRequestModel {

    public function __construct(
        private string $productId,
        private int $amount,
        private float $price,
        private int $id = 0
    )
    {

    }

    public function getProductId() : string {
        return $this->productId;
    }

    public function getId() : string {
        return $this->id;
    }

    public function getPrice() : string {
        return $this->price;
    }

    public function getAmount() : string {
        return $this->amount;
    }
}