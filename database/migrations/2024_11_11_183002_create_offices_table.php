<?php

// database/migrations/xxxx_xx_xx_create_offices_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del consultorio
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('offices');
    }
}