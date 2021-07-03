<?php 

namespace App\Models\RequestModels;

final class ProductRequestModel {

    public function __construct(
        private string $name,
        private float $price,
        private int $id = 0
    )
    {

    }

    public function getName() : string {
        return $this->name;
    }

    public function getId() : string {
        return $this->id;
    }

    public function getPrice() : string {
        return $this->price;
    }
}