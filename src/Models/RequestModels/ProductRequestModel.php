<?php 

namespace App\Models\RequestModels;

use RMValidator\Attributes\PropertyAttributes\Numbers\BiggerAttribute;
use RMValidator\Attributes\PropertyAttributes\Strings\StringLengthAttribute;

final class ProductRequestModel {

    public function __construct(
        private string $name,
        private float $price,
        private int $id = 0
    )
    {

    }

    #[StringLengthAttribute(from: 1, to: 255)]
    public function getName() : string {
        return $this->name;
    }

    public function getId() : string {
        return $this->id;
    }

    #[BiggerAttribute(biggerThan: 0)]
    public function getPrice() : string {
        return $this->price;
    }
}