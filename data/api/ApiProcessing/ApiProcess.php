<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;

abstract class ApiProcess extends ApiHandler
{
    protected Request $request;
    protected Response $response;
    protected ApiHandler $handler;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function execute()
    {
        $apiHandler = new ApiAuth(
            new ApiAuthz($this)
        );

        $apiHandler->handle($this->request, $this->response);
    }
}
