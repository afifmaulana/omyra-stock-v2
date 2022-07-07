<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->unsigned()->nullable();
            $table->foreignId('product_id')->unsigned()->nullable();
            $table->foreignId('material_id')->unsigned()->nullable();
            $table->morphs('modelable');
            $table->date('date');
            $table->string('type');
            $table->string('type_calculation');
            $table->double('stock_before')->default(0);
            // $table->double('stock_before_semifinish')->default(0);
            $table->double('stock_now')->default(0);
            // $table->double('stock_now_semifinish')->default(0);
            $table->double('total')->default(0);

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
        Schema::dropIfExists('record_logs');
    }
}
