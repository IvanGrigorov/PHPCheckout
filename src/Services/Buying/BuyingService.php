<?php

namespace App\Services\Buying;

use App\Models\ResponseModels\CheckoutResponseModel;
use App\Services\Pricing\IPricingService;
use App\Services\Record\IRecordService;

final class BuyingService implements IBuyingService {

    public function __construct(
        private IPricingService $pricingService,
        private IRecordService $recordService)
    {

    }

    public function buy(string $products) : CheckoutResponseModel {
        $pricings = $this->pricingService->calculatePrices($products);
        $this->recordService->record($pricings->productBuyInfo);
        return $pricings;
    }
}