<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rutes', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('vehicle')->nullable();
            $table->string('estat')->default('planificada'); // RutaEstat
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rutes');
    }
};
