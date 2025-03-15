<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('TipoDoc');
            $table->string('Numdoc')->unique();
            $table->string('Nombre');
            $table->string('ApePaterno');
            $table->string('ApeMaterno');
            $table->string('Telefono');
            $table->date('Fechanac');
            $table->string('Genero');
            $table->string('Region');
            $table->string('Provincia');
            $table->string('Distrito');
            $table->string('Direccion');
            $table->string('Gmail')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->rememberToken();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
