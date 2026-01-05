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
     * Validate the information when pushing user information to the server
     * - This algorithm might change in the future when we utilize AI to validate the information that is safe for work
     */
    public function validate($name, $info): bool;

    /**
     * Format user information to make it useful when getting user information for both user page and admin page
     * - Example: 2663 Pineland Ave, Doraville, GA, 30340 -> https://maps.google.com/maps?q=2663 Pineland Ave, Doraville, GA, 30340
     */
    public function format(?string $info): ?string;

    /**
     * Handle chain of handling pushing new data to database
     */
    public function handlePush(Info $info): bool;
    /**
     * Handle each unit of handling pushing new data to database
     */
    public function doHandlePush(Info $info): bool;

    /**
     * Handle chain of getting raw data from database
     */
    public function handleAdminGET(Info $info): bool;
    /**
     * Handle each unit of getting raw data from database
     */
    public function doHandleAdminGET(Info $info): bool;

    /**
     * Handle chain of getting info (already formatted and operated) for user page
     */
    public function handleUserGET(Info $info): bool;
    /**
     * Handle each unit of getting info (already formatted and operated) for user page
     */
    public function doHandleUserGET(Info $info): bool;
}
