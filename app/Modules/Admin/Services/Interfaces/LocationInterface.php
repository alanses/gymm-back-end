<?php

namespace App\Modules\Admin\Services\Interfaces;

interface LocationInterface {
    public function getDataFromSource(string $address);

    public function getLat(array $locationInfo) :?string;

    public function getLng(array $locationInfo) :?string;
}