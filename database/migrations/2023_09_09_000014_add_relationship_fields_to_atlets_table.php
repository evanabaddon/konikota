<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAtletsTable extends Migration
{
    public function up()
    {
        Schema::table('atlets', function (Blueprint $table) {
            $table->unsignedBigInteger('cabor_id')->nullable();
            $table->foreign('cabor_id', 'cabor_fk_8977124')->references('id')->on('cabors');
        });
    }
}
