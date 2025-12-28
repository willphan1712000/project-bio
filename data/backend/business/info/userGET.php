<?php

namespace business\info;

use business\info\Info;

/**
 * This class is for getting user information for user site which is publicly available to everyone
 */
class userGET
{
    private string $username;
    private bool $is_server_render;

    public function __construct(string $username, bool $is_server_render = false)
    {
        $this->username = $username;
        $this->is_server_render = $is_server_render;
    }

    private function get()
    {
        try {
            $info = new Info([]);
            $info->setInfo('username', $this->username);
            $info->setInfo('is_server_render', $this->is_server_render);

            // $userSocialHandler = new Booking(new Facebook(new HotSale(new Instagram(new Linkedin(new Messenger(new OrderOnline(new Pinterest(new Threads(new Tiktok(new Website(new X(new Youtube(new Zalo(null))))))))))))));
            // // Handle user phone number
            // $userPhoneHandler = new Mobile(new Work(new HotLine(new Viber($userSocialHandler))));
            // // Handle user information
            // $userInfoHandler = new Name(new Avatar(new Organization(new Description(new Email(new Address($userPhoneHandler))))));

            $userInfoHandler = InfoChainHandler::getInstance(null);

            $get = $userInfoHandler->handleUserGET($info);

            return [
                'success' => $get,
                'data' => $info->getEntireInfo()
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function execute()
    {
        return $this->get();
    }
}
