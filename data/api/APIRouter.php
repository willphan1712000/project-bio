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

            // User management
            $api_router->get("/api/users", "api\users\GETALL@execute");
            $api_router->get("/api/users/{id}", "api\users\GET@execute");
            $api_router->post("/api/users/register", "api\users\REGISTER@execute");
            $api_router->put("/api/users/{id}", "api\users\PUT@execute");
            $api_router->delete("/api/users/{id}", "api\users\DELETETEMP@execute");
            $api_router->delete("/api/users/delete/{id}", "api\users\DELETE@execute");
            
            // User template preferences such as liked templates, default template, ...
            $api_router->get("/api/template/like/{id}", "api\\template\like\GETLIKED@execute");
            $api_router->post("/api/template/like", "api\\template\like\POSTLIKED@execute");
            $api_router->delete("/api/template/like", "api\\template\like\DELETELIKED@execute");

            $api_router->get("/api/template/default/{id}", "api\\template\default\GETDEFAULT@execute");
            $api_router->put("/api/template/default", "api\\template\default\PUTDEFAULT@execute");


            // Get products from allinclicks.com
            $api_router->get("/api/woo/product", 'api\wp\GETALL@execute');
            $api_router->get('/api/woo/product/{id}', 'api\wp\GET@execute');

            // Get company information such as company name, company address, phone, email, ...
            $api_router->get('/api/branches', 'business\beautyBooking\BranchesController@get');

            // New template management, handling add and modify template information
            $api_router->get('/api/template/manage', 'api\templateManagement\template\GETALL@execute');
            $api_router->get('/api/template/manage/url', 'api\templateManagement\template\GETURL@execute');
            $api_router->get('/api/template/manage/{id}', 'api\templateManagement\template\GET@execute');
            $api_router->post('/api/template/manage', 'api\templateManagement\template\POST@execute');
            $api_router->put('/api/template/manage/{id}', 'api\templateManagement\template\PUT@execute');
            $api_router->delete('/api/template/manage/{id}', 'api\templateManagement\template\DELETE@execute');

            // Get template dimension information
            $api_router->get('/api/template/info/{id}', 'api\templateManagement\info\GET@execute');

            // Get all related user info and template info
            $api_router->post('/api/template', 'api\templateManagement\user\USERGET@execute');

            // Update user info and style
            $api_router->put('/api/template', 'api\templateManagement\user\USERPUT@execute');

            // General resources
            $api_router->get('/api/resources', 'api\resources\GET@execute');
            
            // User personal resources
            $api_router->get('/api/personal/{id}', 'api\resources\GETPERSONAL@execute');

            // Manage pricing
            $api_router->get('/api/pricing', 'api\pricing\GET@execute');
            $api_router->post('/api/pricing', 'api\pricing\POST@execute');
            $api_router->put('/api/pricing/{id}', 'api\pricing\PUT@execute');

            // Manage analytics
            $api_router->get('/api/analytics', 'api\analytics\GET@execute');
            $api_router->get('/api/analytics/social', 'api\analytics\UserSocial@execute');

            // Manage auth
            $api_router->post('/api/auth', 'api\auth\AuthController@postGenerate');
            $api_router->get('/api/auth/check', 'api\auth\AuthController@getUsername');

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
            $pattern = preg_replace('/\{[^\}]+\}/', '([0-9]+|[a-zA-Z]+)', $route['endpoint']);
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
