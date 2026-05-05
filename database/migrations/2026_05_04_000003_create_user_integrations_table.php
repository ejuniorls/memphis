<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_integrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('system');       // IntegrationSystem enum
            $table->string('external_id'); // ID do usuário no sistema externo (ex: matrícula no Protheus)
            $table->json('metadata')->nullable(); // filial, empresa, ambiente, etc.
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->unique(['user_id', 'system']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_integrations');
    }
};
