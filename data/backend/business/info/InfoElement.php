<?php

namespace business\info;

/**
 * This Interface supports
 * - Getting user information for user page
 * - Getting user information for admin page
 * - Pushing user information to the server
 */
interface InfoElement
{
    /**
     * - Validate the information when pushing user information to the server
     * - This algorithm might change in the future when we utilize AI to validate the information that is safe for work
     */
    public function validate($name, $info): bool;

    /**
     * Format user information when getting user information for both user page and admin page
     */
    public function format(?string $info): ?string;

    /**
     * Handle chain of handling push
     */
    public function handlePush(Info $info): bool;
    /**
     * Handle each unit of handling push
     */
    public function doHandlePush(Info $info): bool;

    /**
     * Handle chain of getting info for admin page
     */
    public function handleAdminGET(Info $info): bool;
    /**
     * Handle each unit of getting info for admin page
     */
    public function doHandleAdminGET(Info $info): bool;

    /**
     * Handle chain of getting info for user page
     */
    public function handleUserGET(Info $info): bool;
    /**
     * Handle each unit of getting info for user page
     */
    public function doHandleUserGET(Info $info): bool;
}
