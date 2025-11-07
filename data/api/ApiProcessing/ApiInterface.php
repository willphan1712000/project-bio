<?php

namespace api\ApiProcessing;

interface ApiInterface {
    public function execute(?string $id);
}