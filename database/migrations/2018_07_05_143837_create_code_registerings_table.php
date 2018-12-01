<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeRegisteringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_registerings', function (Blueprint $table) {
            $table->char('phone', 11);
            $table->integer('code');
            $table->integer('sendDate');
            $table->integer('times');
            $table->timestamps();
            $table->primary('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_registerings');
    }
}
