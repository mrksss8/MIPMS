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
        Schema::create('preg_womens', function (Blueprint $table) {
            $table->id();
            $table->string('gradiva');
            $table->string('para');
            $table->date('LMP');
            $table->date('EDC');
            $table->string('TT_status');
            $table->string('name_of_husband');
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
        Schema::dropIfExists('preg_womens');
    }
};
