<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoundCycleFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('round_cycle', function (Blueprint $table) {
            $table->foreign('round_id', 'round_cycle_round_id_fdx')
                ->references('id')
                ->on('round')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('cycle_id', 'round_cycle_cycle_id_fdx')
                ->references('id')
                ->on('cycle')
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
        Schema::table('round_cycle', function (Blueprint $table) {
            $table->dropForeign('round_cycle_round_id_fdx');
            $table->dropForeign('round_cycle_cycle_id_fdx');
        });
    }
}
