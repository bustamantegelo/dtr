<?php


namespace App\Models;

use App\Constants\LogConstants;
use App\Constants\UserConstants;
use Illuminate\Database\Eloquent\Model;

/**
 * Logs
 * @package App\Models
 * @author  Angelo C. Bustamante <bustamantegelo@gmail.com>
 * @since   13/01/2021
 * @version 1.0
 */
class Logs extends Model
{
    /** @var string Table Name */
    protected $table = LogConstants::T_LOGS;

    /** @var string Primary Key */
    protected $primaryKey = LogConstants::LOG_ID;

    /** @var array Public fields that can be filled */
    protected $fillable = [
        LogConstants::TIME_IN,
        LogConstants::TIME_OUT
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
