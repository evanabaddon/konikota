<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPertandingansTable extends Migration
{
    public function up()
    {
        Schema::table('pertandingans', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_8977088')->references('id')->on('events');
            $table->unsignedBigInteger('cabor_id')->nullable();
            $table->foreign('cabor_id', 'cabor_fk_8977089')->references('id')->on('cabors');
            $table->unsignedBigInteger('venue_id')->nullable();
            $table->foreign('venue_id', 'venue_fk_8977090')->references('id')->on('venues');
        });
    }
}
