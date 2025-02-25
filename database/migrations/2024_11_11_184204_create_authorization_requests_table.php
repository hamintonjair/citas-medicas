<?php

// database/migrations/xxxx_xx_xx_create_authorization_requests_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateAuthorizationRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('authorization_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade'); // Elimina la solicitud si se elimina el usuario
            $table->string('phone'); // Cambiado a string
            $table->string('file_path')->nullable(); // Cambiado a string y se permite null por si no hay archivo
            $table->enum('status', ['pendiente', 'autorizada', 'rechazada'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('authorization_requests');
    }
}
