<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missatges_bot', function (Blueprint $table) {
            $table->id();
            $table->string('whatsapp_id'); // remitent (pot no coincidir amb cap client conegut encara)
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('comanda_id')->nullable()->constrained('comandes')->nullOnDelete();
            $table->string('tipus'); // MissatgeBotTipus: text / audio
            $table->text('contingut_raw')->nullable();
            $table->text('transcripcio')->nullable(); // si era àudio
            $table->string('estat'); // MissatgeBotEstat
            $table->timestamps(); // created_at fa de "data"
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missatges_bot');
    }
};
