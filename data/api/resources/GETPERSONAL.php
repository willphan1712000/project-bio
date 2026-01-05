<?php

namespace api\resources;

use api\ApiProcessing\ApiPublic;
use api\Request;
use api\Response;
use business\resources\Footer;

class GETPERSONAL extends ApiPublic
{
    public function doHandle(Request $request, Response $response)
    {
        $username = $request->getId()[0];

        try {
            $resources = new Footer();
            $response->setStatusCode(200)->json([
                'success' => true,
                'data' => $resources->get($username)
            ]);
        } catch (\Exception $e) {
            $response->setStatusCode(404)->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
