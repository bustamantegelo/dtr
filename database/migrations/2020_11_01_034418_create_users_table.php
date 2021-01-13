<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateUsersTable
 * @package ${NAMESPACE}
 * @author  Angelo C. Bustamante <bustamantegelo@gmail.com>
 * @since   13/01/2021
 * @version 1.0
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_USERS', function (Blueprint $table) {
            $table->bigIncrements('user_id')
                ->comment('type: big int, length: 20, comment: User Id');
            $table->string('first_name')
                ->length(128)
                ->comment('type: varchar, length: 255, comment: First name of user');
            $table->string('middle_name')
                ->length(128)
                ->comment('type: varchar, length: 255, comment: Middle name of user');
            $table->string('last_name')
                ->length(128)
                ->comment('type: varchar, length: 255, comment: Last name of user');
            $table->string('username')
                ->unique()
                ->length(128)
                ->comment('type: varchar, length: 128, comment: username');
            $table->string('password')
                ->length(128)
                ->comment('type: varchar, length: 128, comment: password of user');
            $table->string('school')
                ->length(128)
                ->comment('type: varchar, length: 255, comment: School of student user');
            $table->smallInteger('type')
                ->comment('type: varchar, length: 255, comment: Type of user ["0 = Admnin", "1 = Ojt"]');
            $table->smallInteger('designation')
                ->comment('type: varchar, length: 255, comment: Designation of user ["0 = Developer", "1 = Support"]');
            $table->integer('required_hours')
                ->comment('type: int, length: 11, comment: required hours of ojt');
            $table->integer('rendered_hours')
                ->comment('type: int, length: 11, comment: rendered hours of ojt');
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
        Schema::dropIfExists('T_USERS');
    }
}
