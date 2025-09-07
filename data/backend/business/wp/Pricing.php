<?php

namespace business\wp;

use config\APIClient;
use config\SystemConfig;

class Pricing
{
    protected const Page_ID = 3430;
    protected string $endpoint;
    protected APIClient $talkToOther;

    public function __construct()
    {
        $this->endpoint = "/wp-json/wp/v2/pages/" . self::Page_ID;
        $this->talkToOther = new APIClient(
            SystemConfig::globalVariables()['company_domain']
        );
    }

    public function get()
    {
        try {
            $res = $this->talkToOther->get($this->endpoint);

            return $res['content']['rendered'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
