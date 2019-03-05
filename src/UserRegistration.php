<?php declare (strict_types=1);

namespace PerfectApp;

/**
 * Interface UserRegistration
 * @package PerfectApp
 */
interface UserRegistration
{
    /**
     * @param $firstName
     * @param $lastName
     * @param $to
     * @param $username
     * @param $password
     * @param $url
     * @param $admin_email
     * @return mixed
     */
    public function register($firstName, $lastName, $to, $username, $password, $url, $admin_email);
}
