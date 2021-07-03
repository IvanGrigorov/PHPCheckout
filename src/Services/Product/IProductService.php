<?php

namespace App\Services\Product;

use App\Models\RequestModels\ProductRequestModel;

interface IProductService {

    public function create(ProductRequestModel $productRequestModel) : int;

    public function update(ProductRequestModel $productRequestModel) : bool;

    public function delete(int $productId) : bool;

}