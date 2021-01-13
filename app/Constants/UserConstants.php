<?php


namespace App\Constants;

/**
 * UserConstants
 * @package App\Constants
 * @author  Angelo C. Bustamante <bustamantegelo@gmail.com>
 * @since   13/01/2021
 * @version 1.0
 */
class UserConstants
{
    /** Constant table name */
    const T_USERS = 't_users';

    /** Constant table primary key */
    const USER_ID = 'user_id';

    /** Constant table column */
    const FIRST_NAME = 'first_name';
    const MIDDLE_NAME = 'middle_name';
    const LAST_NAME = 'last_name';
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const SCHOOL = 'school';
    const TYPE = 'type';
    const DESIGNATION = 'designation';
    const REQUIRED_HOURS = 'required_hours';
    const RENDERED_HOURS = 'rendered_hours';
}
