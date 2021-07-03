<?php

namespace App\Services\Pricing;

use App\Models\ResponseModels\CheckoutResponseModel;

interface IPricingService {

    public function calculatePrices(string $items) : CheckoutResponseModel;
}