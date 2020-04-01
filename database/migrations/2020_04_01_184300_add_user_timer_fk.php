<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTimerFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_timer', function(Blueprint $table) {
            $table->foreign('user_id', 'user_timer_user_id_fdx')
                ->references('id')
                ->on('user')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('timer_id', 'user_timer_timer_id_fdx')
                ->references('id')
                ->on('timer')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_timer', function(Blueprint $table) {
            $table->dropForeign('user_timer_user_id_fdx');
            $table->dropForeign('user_timer_timer_id_fdx');
        });
    }
}
