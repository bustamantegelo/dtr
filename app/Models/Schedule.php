<?php


namespace App\Models;

use App\Constants\ScheduleConstants;
use App\Constants\UserConstants;
use Illuminate\Database\Eloquent\Model;

/**
 * Schedule
 * @package App\Models
 * @author  Angelo C. Bustamante <bustamantegelo@gmail.com>
 * @since   13/01/2021
 * @version 1.0
 */
class Schedule extends Model
{
    /** @var string Table Name */
    protected $table = ScheduleConstants::T_SCHEDULE;

    /** @var string Primary Key */
    protected $primaryKey = ScheduleConstants::SCHEDULE_ID;

    /** @var array Public fields that can be filled */
    protected $fillable = [
        ScheduleConstants::SCHEDULE_TIME_IN,
        ScheduleConstants::SCHEDULE_TIME_OUT
    ];

    /**
     * t_users table relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function t_users()
    {
        return $this->belongsTo(
            'App\Models\Users',
            UserConstants::USER_ID,
            UserConstants::USER_ID
        );
    }
}
