<?php
namespace api\wp;

use api\ApiProcessing\ApiPublic;
use api\Request;
use api\Response;
use config\ExternalServices\wp\Products;

class GETALL extends ApiPublic {
    public function doHandle(Request $request, Response $response)
    {
        $products = (new Products())->getAll();

        $response->setStatusCode(200)->json($products);
    }
}
?>