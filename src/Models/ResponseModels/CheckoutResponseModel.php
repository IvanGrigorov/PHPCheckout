<?php 

namespace App\Models\ResponseModels;

final class CheckoutResponseModel {

    public function __construct(
        public array $productBuyInfo,
        public float $totalPrice
    )
    {
        
    }
}