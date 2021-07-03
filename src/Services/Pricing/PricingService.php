<?php

namespace App\Services\Pricing;

use App\Entity\Product;
use App\Entity\Promotion;
use App\Models\ResponseModels\CheckoutResponseModel;
use App\Repository\ProductRepository;
use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\Collection;

final class PricingService implements IPricingService {

    public function __construct(
        private ProductRepository $prodRepo,
        private PromotionRepository $promRepo
    ) {

    }

    public function calculatePrices(string $items) : CheckoutResponseModel {
        $trackedProducts = [];
        $prices = [];
        $total = 0;
        for($i = 0; $i < strlen($items); $i++) {
            $productName = $items[$i];
            if (in_array($productName, $trackedProducts)) {
                continue;
            }
            $productAmount = substr_count($items, $productName);
            $product = $this->prodRepo->findOneByName($productName);
            $promotions =  $product->getPromotions();
            $price = $this->returnPriceForProduct($productAmount, $promotions, $product);
            $total += $price;
            $prices[] = ['product' => $productName, 'price' => $price, 'amount' => $productAmount];
            $trackedProducts[] = $productName;
        }
        return new CheckoutResponseModel($prices, $total);
    }

    private function returnPriceForProduct(int $amount, Collection $promotions, Product $product) : float {
        $tmpAmount = $amount;
        $tmpValue = 0;
        while ($tmpAmount != 0) {
            $promotion = $this->getDiscount($tmpAmount, $promotions);
            if (empty($promotion)) {
                return $tmpValue + $tmpAmount * $product->getPrice();
            }
            else {
                $tmpValue = intdiv($amount, $promotion->getAmount()) * $promotion->getPrice();
                $tmpAmount = $tmpAmount % $promotion->getAmount();
            }

        }
        return $tmpValue;
    }

    private function getDiscount(int $amount, Collection $promotions) : ?Promotion {
        foreach($promotions as $promotion) {
            if ($amount > $promotion->getAmount() || $amount == $promotion->getAmount()) {
                return $promotion;
            }
        }
        return null;
    }


}