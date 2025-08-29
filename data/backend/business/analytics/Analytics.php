<?php

namespace business\analytics;

use config\SystemConfig;
use config\TalkToOtherServer;
use persistence\Database;
use persistence\Entity\UserSocial;

class Analytics
{
    protected TalkToOtherServer $otherServer;
    protected static string $Template_Server_URL;
    protected static string $template_server_endpoint;
    protected static string $Payment_Server_URL;
    protected static string $payment_server_endpoint;
    public function __construct()
    {
        $this->otherServer = TalkToOtherServer::getInstance();
        self::$Template_Server_URL = SystemConfig::globalVariables()['template_server']['url'];
        self::$template_server_endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['template'];
    }
    /**
     * This function will return total number of Users.
     * The current approach is bad because it constantly retrieves or runs query for total users. Later on, we should implement Table View concept to get total users whenever a new user registers to the app.
     * However, this query is only run by admin, so this is not that bad, still accepted.
     * @return int total number of users
     */
    public function getTotalUsers(): int
    {
        $sql = Database::SQL("SELECT COUNT(*) FROM User");
        return $sql[0]['COUNT(*)'];
    }

    /**
     * This function return number of social links for each of the social types (Facebook, Instagram,...)
     */
    public function getSocial(): array
    {
        $social = [];
        $socialEntities = UserSocial::getProperty();
        foreach ($socialEntities as $socialEntity) {
            if ($socialEntity === 'username' || $socialEntity === 'User') continue;

            array_push($social, [
                "name" => $socialEntity,
                "value" => Database::SQL("SELECT COUNT(*) FROM UserSocial WHERE $socialEntity IS NOT null")[0]['COUNT(*)']
            ]);
        }

        return $social;
    }

    /**
     * This function handles getting total number of records (templates) uploaded on Template server
     */
    public function getTotalTemplate()
    {
        $res = $this->otherServer->get(
            self::$Template_Server_URL . self::$template_server_endpoint . "/count"
        );

        if (!$res['success'] || !$res['data']['success']) {
            return -1;
        }

        return $res['data']['data'];
    }
}
