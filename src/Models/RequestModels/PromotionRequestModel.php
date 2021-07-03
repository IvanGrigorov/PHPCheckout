<?php 

namespace App\Models\RequestModels;

use RMValidator\Attributes\PropertyAttributes\Numbers\BiggerAttribute;

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

    #[BiggerAttribute(biggerThan: 0)]
    public function getPrice() : string {
        return $this->price;
    }

    #[BiggerAttribute(biggerThan: 10)]
    public function getAmount() : string {
        return $this->amount;
    }
}