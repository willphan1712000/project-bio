<?php

namespace business\user;

use business\auth\Auth;
use config\SystemConfig;
use persistence\Database;
use persistence\Entity\User;

interface IUserManagement
{
    public static function isSignedIn(&$SESSION, ?string $username, ?string $token): bool;
    public static function auth(&$SESSION, string $username, string $password): bool;
    public static function URLGenerator(string $username, string $c): string|null;
    public static function isUserExist($username): bool;
    public static function isEmailMatchUsername(string $username, string $email): bool;
}

class UserManagement implements IUserManagement
{
    /**
     * This function handles checking whether or not the user is signed in
     */
    public static function isSignedIn(&$SESSION, ?string $username = null, ?string $token = null): bool
    {
        $authStrategy = new Auth($username, null, $token);
        return $authStrategy->auth()['success'];
    }

    /**
     * This function handles granting user session or token to access resources
     */
    public static function auth(&$SESSION, string $username, string $password): bool
    {
        $authStrategy = new Auth($username, $password);
        return $authStrategy->generateAuth();
    }

    /**
     * This function is to create url for user
     */
    public static function URLGenerator(string $username, string $c = "main" | "share"): string|null
    {
        if ($c === "main") {
            return "https://" . SystemConfig::globalVariables()["domain"] . "/" . $username;
        } elseif ($c === "share") {
            return "https://" . SystemConfig::globalVariables()["domain"] . "/" . $username . "?share=true";
        }
        return NULL;
    }

    /**
     * Check if username exists, return true if exists. Otherwise, return false
     */
    public static function isUserExist($username): bool
    {
        try {
            if ($username === SystemConfig::globalVariables()['aicAccount']['username']) {
                return true;
            }

            $result = Database::GET(User::class, null, ['username' => $username]);

            if ($result) {
                if ($result->get("username") === $username) {
                    return true;
                }
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }

    /**
     * Check if email matches a username, return true if exists. Otherwise, return false
     */
    public static function isEmailMatchUsername(string $username, string $email): bool
    {
        if (self::isUserExist($username)) {
            try {
                /** @var User|NULL */
                $result = Database::GET(User::class, null, ['username' => $username]);
                $emailFromDB = $result->get("email"); // get email from database for corresponding username
                if ($email === $emailFromDB) {
                    return true;
                }
                return false;
            } catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }
}
