<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertandingansTable extends Migration
{
    public function up()
    {
        Schema::create('pertandingans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('hasil')->nullable();
            $table->string('medali')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
