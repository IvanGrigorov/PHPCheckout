<?php

use App\Services\Pricing\PricingService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class PricingServiceTest extends KernelTestCase{


    private PricingService $pricingService;

    /**
     * @dataProvider productsProvider
     */
    public function test_returnPriceForProduct_shouldReturnCorrectValue(string $products, float $price) {

        // Arrange
        self::bootKernel();
        $container = self::getContainer();
        // Move in the setup for multiple tests
        $this->pricingService = $container->get(PricingService::class);

        //Act
        $pricesModel = $this->pricingService->calculatePrices($products);

        //Assert
        $this->assertSame($price, $pricesModel->totalPrice);
    }

    public function productsProvider(): array
    {

        return [
            ['A', 50],
            ['AB', 80],
            ['CDBA', 110],
            ['AA', 100],
            ['AAA', 130],
            ['AAAA', 180],
            ['AAAAAA', 260],
            ['AAAB', 160],
            ['AAABB', 175],
            ['AAABBD', 185],
            ['AAABBD', 185]
        ];
    }
}