<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimerSetFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timer_set', function(Blueprint $table) {
            $table->foreign('timer_id', 'timer_id_fdx')
                ->references('id')
                ->on('timer')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('set_id', 'set_id_fdx')
                ->references('id')
                ->on('set')
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
        Schema::table('timer_set', function(Blueprint $table) {
            $table->dropForeign('timer_id_fdx');
            $table->dropForeign('set_id_fdx');
        });
    }
}
