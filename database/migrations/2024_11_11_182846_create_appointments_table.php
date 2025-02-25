<?php

// database/migrations/xxxx_xx_xx_create_appointments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Paciente
            $table->foreignId('doctor_id')->constrained('doctors'); // Médico
            $table->foreignId('office_id')->constrained('offices'); // Consultorio
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['pendiente', 'autorizada', 'rechazada']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}