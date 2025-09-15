<?php

namespace controllers\deactivate;

use business\user\activation\GET;
use config\SystemConfig;
use controllers\Controller;

class DeactivateController extends Controller
{
    protected ?string $username;
    protected ?string $signinUrl;

    public function __construct()
    {
        $this->username = SystemConfig::URLExtraction(queryStr: "username") ?? null;
        $this->signinUrl = '/@signin';
    }

    public function execute()
    {
        $this->redirect();
    }

    private function redirect()
    {
        if ($this->username === null) {
            header("Location: " . $this->signinUrl);
        }

        try {
            $deleteToken = (new GET($this->username))->execute();
            if ($deleteToken === null) {
                header("Location: /" . $this->username);
            }
        } catch (\Exception $e) {
            header("Location: " . $this->signinUrl);
        }
    }
}
