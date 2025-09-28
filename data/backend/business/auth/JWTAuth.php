<?php

namespace business\auth;

use api\Request;
use config\SystemConfig;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;
use Exception;

Dotenv::createImmutable(__DIR__ . "./../../../../")->load();

/**
 * JWT-based Authorization
 */
class JWTAuth implements AuthInterface
{
    protected ?string $username;
    protected ?string $token;

    public function __construct(?Request $request = NULL)
    {
        $tokenName = SystemConfig::globalVariables()['auth']['token_property'];
        if ($request === NULL) {
            $this->username = $_POST['username'] ?? NULL;
            $this->token = $_COOKIE[$tokenName] ?? NULL;
        } else {
            $headers = $request->getHeaders();
            $body = $request->getBody();
            $this->username = $body['username'];
            $this->token = $_COOKIE[$tokenName] ?? ($headers[$tokenName] ?? NULL);
        }
    }

    public function auth(): array
    {
        if ($this->token === NULL) return [
            'success' => false
        ];

        try {
            $decode = JWT::decode($this->token, new Key($_ENV['JWT_SECRET'], 'HS256'));
            $username = $decode->username;
            if (isset($decode->username)) {
                return [
                    'success' => true,
                    'username' => $username
                ];
            }
        } catch (\Exception $e) {
            // Invalid signature
            return [
                'success' => false
            ];
        }
        return [
            'success' => false
        ];
    }

    public function generateAuth(): bool|string
    {
        $token = JWT::encode([
            "username" => $this->username,
            "iat" => time(),
            "exp" => time() + SystemConfig::globalVariables()['timeSession']
        ], $_ENV['JWT_SECRET'], 'HS256');

        return $token;
    }
}
