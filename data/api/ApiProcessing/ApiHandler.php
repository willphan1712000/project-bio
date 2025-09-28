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
        if (!$this->doHandle($request, $response)) {
            return;
        }

        if ($this->next != null) {
            $this->next->handle($request, $response);
        }
    }

    abstract function doHandle(Request $request, Response $response);
}
