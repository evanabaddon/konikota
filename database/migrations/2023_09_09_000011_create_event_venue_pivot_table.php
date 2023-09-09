<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventVenuePivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_venue', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_8977086')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('venue_id');
            $table->foreign('venue_id', 'venue_id_fk_8977086')->references('id')->on('venues')->onDelete('cascade');
        });
    }
}
