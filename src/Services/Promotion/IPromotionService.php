<?php

namespace App\Services\Promotion;

use App\Models\RequestModels\ProductRequestModel;
use App\Models\RequestModels\PromotionRequestModel;

interface IPromotionService {

    public function create(PromotionRequestModel $promotionRequestModel) : int;

    public function update(PromotionRequestModel $promotionRequestModel) : bool;

    public function delete(int $promotionId) : bool;

}