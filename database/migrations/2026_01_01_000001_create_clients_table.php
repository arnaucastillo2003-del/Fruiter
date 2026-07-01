<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('tipus'); // ClientTipus: restaurant / comerc / mercat
            $table->string('adreca')->nullable();
            $table->decimal('latitud', 10, 7)->nullable();
            $table->decimal('longitud', 10, 7)->nullable();
            $table->string('telefon')->nullable();
            $table->string('whatsapp_id')->nullable()->unique(); // per identificar qui escriu al bot
            $table->string('condicions_pagament')->nullable(); // "30 dies", "efectiu"...
            $table->boolean('actiu')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
