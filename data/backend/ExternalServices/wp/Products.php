<?php

namespace config\ExternalServices\wp;

use Automattic\WooCommerce\Client;
use config\SystemConfig;

class Products
{
    protected $woocommerce;
    protected const EBUSINESS_CATEGORY_ID = 115;

    public function __construct()
    {
        $this->woocommerce = new Client(
            SystemConfig::globalVariables()['company_domain'],
            $_ENV["WOO_KEY"],
            $_ENV["WOO_SECRET"],
            [
                'version' => 'wc/v3',
            ]
        );
    }

    public function getAll()
    {
        $id = self::EBUSINESS_CATEGORY_ID;
        return [
            "success" => true,
            "products" => $this->woocommerce->get("products?category=$id")
        ];
    }

    public function getWithId($id)
    {
        $products = $this->woocommerce->get('products/' . $id);
        return [
            "success" => true,
            "product" => json_decode(json_encode($products), true)
        ];
    }
}
