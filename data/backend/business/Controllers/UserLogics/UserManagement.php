<?php

namespace business\Controllers\UserLogics;

use business\auth\Auth;
use config\SystemConfig;
use persistence\Database;
use persistence\Entity\User;

interface IUserManagement
{
    /**
     * This function handles granting user session or token to access resources
     */
    public static function auth(string $username, string $password): bool;

    /**
     * This function is to create url for user
     */
    public static function URLGenerator(string $username, string $c): string|null;

    /**
     * Check if username exists, return true if exists. Otherwise, return false
     */
    public static function isUserExist($username): bool;

    /**
     * Check if email matches a username, return true if exists. Otherwise, return false
     */
    public static function isEmailMatchUsername(string $username, string $email): bool;
}

class UserManagement implements IUserManagement
{
    public static function auth(string $username, string $password): bool
    {
        $authStrategy = new Auth();
        return $authStrategy->generateAuth();
    }

    public static function URLGenerator(string $username, string $c = "main" | "share"): string|null
    {
        if ($c === "main") {
            return "https://" . SystemConfig::globalVariables()["domain"] . "/" . $username;
        } elseif ($c === "share") {
            return "https://" . SystemConfig::globalVariables()["domain"] . "/" . $username . "?share=true";
        }
        return NULL;
    }

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

    public static function createHashedPassword(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
