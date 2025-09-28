<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;

abstract class ApiHandler
{
    private ?ApiHandler $next;

    public function __construct(?ApiHandler $next = null)
    {
        $this->next = $next;
    }

    public function handle(Request $request, Response $response)
    {
        try {
            if (!$this->doHandle($request, $response)) return;
        } catch (\Exception $e) {
            $response->setStatusCode(400)->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            return;
        }

        if ($this->next != null) {
            $this->next->handle($request, $response);
        }
    }

    abstract function doHandle(Request $request, Response $response);
}
