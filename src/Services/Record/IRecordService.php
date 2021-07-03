<?php

namespace App\Services\Record;

interface IRecordService {

    public function record(array $products) : void;
}