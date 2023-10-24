<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaborEventPivotTable extends Migration
{
    public function up()
    {
        Schema::create('cabor_event', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_8979182')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('cabor_id');
            $table->foreign('cabor_id', 'cabor_id_fk_8979182')->references('id')->on('cabors')->onDelete('cascade');
        });
    }
}
