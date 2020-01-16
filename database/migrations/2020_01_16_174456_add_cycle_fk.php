<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCycleFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cycle', function (Blueprint $table) {
            $table->foreign('type_id', 'cycle_type_id_fdx')
                ->references('id')
                ->on('type')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('sound_id', 'cycle_sound_id_fdx')
                ->references('id')
                ->on('sound')
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
        Schema::table('cycle', function (Blueprint $table) {
            $table->dropForeign('cycle_type_id_fdx');
            $table->dropForeign('cycle_sound_id_fdx');
        });
    }
}
