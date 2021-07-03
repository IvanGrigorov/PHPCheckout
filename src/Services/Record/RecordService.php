<?php

namespace App\Services\Record;

use App\Entity\Record;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

final class RecordService implements IRecordService {

    public function __construct(
        private EntityManagerInterface $entityManager)
    {

    }

    public function record(array $products) : void {
        foreach ($products as $product) {
            $record = new Record();
            $record->setName($product['product']);
            $record->setPrice($product['price']);
            $record->setAmount($product['amount']);
            // Set Default TimeZone In Kernel Or Use MYSQL NOW()
            $record->setDate(new DateTime('now'));
            $this->entityManager->persist($record);
        }
        $this->entityManager->flush();
    }
}