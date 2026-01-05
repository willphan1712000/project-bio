<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;

/**
 * This API class is designed for public resources that can be accessed by anyone with api routes
 * - Have your concrete implementation extend this class to freely access resources with given api routes
 */
abstract class ApiPublic extends ApiHandler implements ApiInterface {
    protected Request $request;
    protected Response $response;
    protected ApiHandler $handler;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    function execute(?string $id = null)
    {
        try {
            $this->request->setId($id);

            $apiHandler = new ApiSecret($this);
            $apiHandler->handle($this->request, $this->response);
        } catch (\Exception $e) {
            $this->response->setStatusCode(400)->json([
                "success" => false,
                "error" => $e->getMessage()
            ]);
        }
    }
}