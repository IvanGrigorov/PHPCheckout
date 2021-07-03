<?php

namespace App\Services\Buying;

use App\Models\ResponseModels\CheckoutResponseModel;

interface IBuyingService {

    public function buy(string $products) : CheckoutResponseModel;    }