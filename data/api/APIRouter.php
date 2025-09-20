<?php

namespace api;

class APIRouter
{
    private Request $request;
    private Response $response;
    private $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * This function will capture all api calls from the client and resolve it and send response back to the client
     */
    public static function api_work()
    {
        if (str_starts_with($_SERVER['REQUEST_URI'], '/api/')) {
            $api_router = new APIRouter(new Request(), new Response());
            $api_router->get("/api/woo/product", 'business\wp\ProductController@getAll');
            $api_router->get('/api/woo/product/{id}', 'business\wp\ProductController@getWithId');

            $api_router->get('/api/branches', 'business\beautyBooking\BranchesController@get');

            $api_router->get('/api/template/manage', 'api\templateManagement\template\GETALL@execute');
            $api_router->get('/api/template/manage/{id}', 'api\templateManagement\template\GET@execute');
            $api_router->get('/api/template/manage/url', 'api\templateManagement\template\GETURL@execute');
            $api_router->post('/api/template/manage', 'api\templateManagement\template\POST@execute');
            $api_router->put('/api/template/manage/{id}', 'api\templateManagement\template\PUT@execute');
            $api_router->delete('/api/template/manage/{id}', 'api\templateManagement\template\DELETE@execute');

            $api_router->get('/api/template/info/{id}', 'api\templateManagement\info\GET@execute');

            $api_router->post('/api/template', 'api\templateManagement\user\USERGET@execute');
            $api_router->put('/api/template', 'api\templateManagement\user\USERPUT@execute');
            $api_router->post('/api/resources', 'api\resources\GET@execute');

            $api_router->get('/api/pricing', 'api\pricing\GET@execute');
            $api_router->post('/api/pricing', 'api\pricing\POST@execute');
            $api_router->put('/api/pricing/{id}', 'api\pricing\PUT@execute');

            $api_router->get('/api/analytics', 'api\analytics\GET@execute');
            $api_router->get('/api/analytics/social', 'api\analytics\UserSocial@execute');

            $api_router->post('/api/auth', 'api\auth\AuthController@postGenerate');
            $api_router->post('/api/auth/check', 'api\auth\AuthController@postValidate');

            $api_router->resolve();

            exit;
        }
    }

    /**
     * This function is for adding route to routes
     * @param method: method of the request (GET, POST, PUT, DELETE)
     * @param endpoint: api url (/api/product/...)
     * @param hanlder: api hanlder - resolver to resolve a request
     */
    private function addRoute($method, $endpoint, $handler)
    {
        $this->routes[] = compact('method', 'endpoint', 'handler');
    }

    /**
     * This function can be get, post, put, delete
     * @param method: name of the method, can be get, post, put, delete
     * @param args: the rest of the arguments
     */
    public function __call($method, $args)
    {
        $this->addRoute(strtoupper($method), ...$args);
    }

    public function resolve()
    {
        // Loop over all routes
        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{[^\}]+\}/', '([0-9]+)', $route['endpoint']);
            // Identify which route and which method to use
            if ($this->request->getMethod() === $route['method'] && preg_match("#^$pattern$#", $this->request->getEndpoint(), $matches)) {
                $handlerParts = explode('@', $route['handler']);
                $controllerName = $handlerParts[0];
                $methodName = $handlerParts[1];
                $controller = new $controllerName($this->request, $this->response);

                array_shift($matches);
                return call_user_func_array([$controller, $methodName], $matches);
            }
        }

        $this->response->setStatusCode(404)->json(['error' => 'Not Found']);
    }
}

/**
 * Request should have header and body
 */
class Request
{
    public function getEndpoint()
    {
        return strtok($_SERVER['REQUEST_URI'], "?");
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody()
    {
        return json_decode(file_get_contents("php://input"), true);
    }

    public function getHeaders()
    {
        return getallheaders();
    }
}

/**
 * Response should have response status code and data
 */
class Response
{
    public function setStatusCode($code)
    {
        http_response_code($code);
        return $this;
    }

    public function json($data)
    {
        header('Access-Control-Allow-Origin');
        header('Content-Type: application/json');
        echo json_encode($data);
        return $this;
    }
}
