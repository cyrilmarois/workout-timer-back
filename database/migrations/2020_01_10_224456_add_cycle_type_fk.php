<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCycleTypeFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cycle', function (Blueprint $table) {
            $table->foreign('type_id', 'type_id_fdx')
            ->references('id')
            ->on('type')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

            $table->foreign('sound_id', 'sound_id_fdx')
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
        //
    }
}
