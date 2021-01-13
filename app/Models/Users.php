<?php

namespace App\Models;

use App\Constants\UserConstants;
use Illuminate\Database\Eloquent\Model;

/**
 * Users
 * @package App\Models
 * @author  Angelo C. Bustamante <bustamantegelo@gmail.com>
 * @since   13/01/2021
 * @version 1.0
 */
class Users extends Model
{
    /** @var string Table Name */
    protected $table = UserConstants::T_USERS;

    /** @var string Primary Key */
    protected $primaryKey = UserConstants::USER_ID;

    /** @var array Public fields that can be filled */
    protected $fillable = [
        UserConstants::FIRST_NAME,
        UserConstants::MIDDLE_NAME,
        UserConstants::LAST_NAME,
        UserConstants::USERNAME,
        UserConstants::PASSWORD,
        UserConstants::SCHOOL,
        UserConstants::TYPE,
        UserConstants::DESIGNATION,
        UserConstants::REQUIRED_HOURS,
        UserConstants::RENDERED_HOURS
    ];

    /**
     * Relationship with t_logs table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function t_logs()
    {
        return $this->hasMany(
            'App\Models\Logs',
            $this->primaryKey
        );
    }

    /**
     * Relationship with t_schedule table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function t_schedule()
    {
        return $this->hasMany(
            'App\Models\Schedule',
            $this->primaryKey
        );
    }
}
