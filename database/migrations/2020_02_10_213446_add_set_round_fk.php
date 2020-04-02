<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSetRoundFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('set_round', function (Blueprint $table) {
            $table->foreign('set_id', 'set_round_set_id_fdx')
                ->references('id')
                ->on('set')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('round_id', 'set_round_round_id_fdx')
                ->references('id')
                ->on('round')
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
        Schema::table('set_round', function (Blueprint $table) {
            $table->dropForeign('set_round_set_id_fdx');
            $table->dropForeign('set_round_round_id_fdx');
        });
    }
}
