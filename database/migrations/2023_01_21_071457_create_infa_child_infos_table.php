<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infa_child_infos', function (Blueprint $table) {
            $table->id();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('place_delivery');
            $table->string('type_of_delivery');
            $table->string('attended_by');
            $table->integer('birth_weight');
            $table->integer('birth_height');
            $table->date('date_of_NBS');
            $table->string('mother_TT_status');
            $table->string('immun_at_other_facility');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infa_child_infos');
    }
};
