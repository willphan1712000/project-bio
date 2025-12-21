<?php
namespace api\wp;

use api\ApiProcessing\ApiPublic;
use api\Request;
use api\Response;
use config\ExternalServices\wp\Products;

class GET extends ApiPublic {
    public function doHandle(Request $request, Response $response)
    {
        $id = $request->getId()[0];

        $product = (new Products())->getWithId($id);

        $response->setStatusCode(200)->json($product);
    }
}
?>