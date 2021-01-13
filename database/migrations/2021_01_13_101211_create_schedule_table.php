<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateScheduleTable
 * @package ${NAMESPACE}
 * @author  Angelo C. Bustamante <bustamantegelo@gmail.com>
 * @since   13/01/2021
 * @version 1.0
 */
class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_SCHEDULE', function (Blueprint $table) {
            $table->bigIncrements('schedule_id')
                ->comment('type: big int, length: 20, comment: Schedule Id');
            $table->bigInteger('user_id')
                ->unsigned()
                ->comment('type: int, length: 10, comment: User Id');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('T_USERS')
                ->onDelete('cascade');
            $table->timestamp('schedule_time_in')
                ->comment('type: timestamp, length: , comment: schedule time in of ojt user');
            $table->timestamp('schedule_time_out')
                ->nullable()
                ->comment('type: timestamp, length: , comment: schedule time out of ojt user');
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->comment('type: timestamp, length: , comment: row created date');
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
                ->comment('type: timestamp, length: , comment: row updated date');
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('T_SCHEDULE');
    }
}
