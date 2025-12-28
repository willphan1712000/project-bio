<?php

namespace business\templateManagement;

use business\Controllers\UserLogics\UserManagement;
use business\info\GET as InfoGET;
use business\info\Info;
use business\info\PUT;
use business\info\userGET;
use business\style\GET;
use business\style\PUT as StylePUT;
use business\template\TemplateManagement;
use business\templateManagement\Template;
use business\templateManagement\TemplateInfo;
use config\SystemConfig;

class TemplateUser
{
    protected Template $template;
    protected TemplateInfo $templateInfo;
    protected $g;

    public function __construct()
    {
        $this->template = new Template();
        $this->templateInfo = new TemplateInfo();
        $this->g = SystemConfig::globalVariables();
    }

    private function getUserResources($username)
    {
        return [
            'qrcode' => $this->g['absolute_user_folder'] . $username . '/qr-code.png',
            'vcard' => $this->g['absolute_user_folder'] . $username . '/vcard.php',
            'share' => UserManagement::URLGenerator($username, "share")
        ];
    }

    /**
     * Get user info from username
     */
    private function getUserInfo($username)
    {
        // Get user info
        $infoObj = new userGET($username);
        $info = $infoObj->execute();
        if (!$info['success']) {
            throw new \Exception($info['error']);
        }

        return $info['data'];
    }

    /**
     * Get user style from username
     */
    private function getUserStyle($username)
    {
        // Get style info
        $styleObj = new GET($username);
        $style = $styleObj->execute();
        if (!$style['success']) {
            throw new \Exception($style['error']);
        }

        return $style['data'];
    }

    /**
     * Get user admin info -> raw information from database, making the upcoming update consistent
     */
    private function getAdminInfo($username) {
        $get = new InfoGET($username);
        $info = $get->execute();
        if(!$info['success']) {
            throw new \Exception($info['error']);
        }

        return $info['data'];
    }

    /**
     * Bundle in one call method as user get
     */
    public function getUser($username)
    {
        return [
            'raw_info' => $this->getAdminInfo($username),
            'user_style' => $this->getUserStyle($username),
            'user_info' => $this->getUserInfo($username),
            'user_resources' => $this->getUserResources($username)
        ];
    }

    /**
     * Update user info from username and info array
     */
    private function updateUserInfo($username, $infoArray)
    {
        return (
            new PUT(
                new Info(
                    $infoArray
                )
            )
        )->execute();
    }

    /**
     * Update user style from username and style array
     */
    private function updateUserStyle($username, $styleArray)
    {
        return (
            new StylePUT(
                $username,
                $styleArray
            )
        )->execute();
    }

    /**
     * Bundle in one method call as user update
     * - This also implements transaction for info and style update
     */
    public function updateUser(string $username, array $infoArray, array $styleArray): bool
    {
        $userInfoCache = $this->getUserInfo($username);
        $userStyleCache = $this->getUserStyle($username);

        $isUserInfoUpdate = $this->updateUserInfo(
            $username,
            $infoArray
        );

        $isUserStyleUpdate = $this->updateUserStyle(
            $username,
            $styleArray
        );

        if ($isUserInfoUpdate && $isUserStyleUpdate)
            return true;

        // case : info update success and style update fail, roll back info update
        if ($isUserInfoUpdate && !$isUserStyleUpdate) {
            $this->updateUserInfo(
                $username,
                $userInfoCache
            );

            return false;
        }

        // case : info update fail and style update sucess, roll back style update
        if (!$isUserInfoUpdate && $isUserStyleUpdate) {
            $this->updateUserStyle(
                $username,
                $userStyleCache
            );

            return false;
        }

        // case : both fail, roll back both
        $this->updateUserInfo(
            $username,
            $userInfoCache
        );
        $this->updateUserStyle(
            $username,
            $styleArray
        );

        return false;
    }

    /**
     * Get all related template information
     */
    public function getTemplate($username, $template_id)
    {
        // Get default template from user
        $id = TemplateManagement::shareTemplate($username, $template_id);

        // Get template from template server
        $template = $this->template->get($id);
        if (!$template['success']) {
            throw new \Exception($template['error']);
        }

        // Get template info from template server
        $template_info = $this->templateInfo->get($id);
        if (!$template_info['success']) {
            throw new \Exception($template_info['error']);
        }

        // Template server URL
        $url = $this->template->getTemplateServerURL();

        return [
            "template" => $template['data'],
            "template_info" => $template_info['data'],
            "template_server_url" => $url
        ];
    }
}
