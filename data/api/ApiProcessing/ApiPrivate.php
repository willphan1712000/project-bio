<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;

/**
 * This API is designed for private API that requires authentication and authorization to accces resources
 * - Have your concrete impletation extend this class to have full control over auth and authz
 */
abstract class ApiPrivate extends ApiHandler implements ApiInterface
{
    protected Request $request;
    protected Response $response;
    protected ApiHandler $handler;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function execute(?string $id = null)
    {
        try {
            $this->request->setId($id);
    
            $apiHandler = new ApiAuth(
                new ApiAuthz($this)
            );
    
            $apiHandler->handle($this->request, $this->response);
        } catch (\Exception $e) {
            $this->response->setStatusCode(400)->json([
                "success" => false,
                "error" => $e->getMessage()
            ]);
        }
    }
}
