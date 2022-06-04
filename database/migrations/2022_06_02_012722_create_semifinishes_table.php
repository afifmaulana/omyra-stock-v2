<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemifinishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semifinishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->unsigned();
            $table->foreignId('material_id')->unsigned();
            $table->date('date');
            $table->date('unloading_date');
            $table->integer('total')->default(0);
            $table->foreignId('user_id')->unsigned();
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
        Schema::dropIfExists('semifinishes');
    }
}
