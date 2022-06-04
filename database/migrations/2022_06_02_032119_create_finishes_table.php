<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->unsigned();
            $table->foreignId('inner_id')->unsigned();
            $table->integer('need_inner')->default(0);
            $table->foreignId('master_id')->unsigned();
            $table->date('date');
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
        Schema::dropIfExists('finishes');
    }
}
