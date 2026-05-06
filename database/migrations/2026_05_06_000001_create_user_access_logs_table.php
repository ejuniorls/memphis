<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_access_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('device')->nullable();      // desktop | mobile | tablet
            $table->string('browser')->nullable();
            $table->string('platform')->nullable();
            $table->string('location')->nullable();    // cidade, país aproximado
            $table->string('event')->default('login'); // login | logout | failed
            $table->timestamps();
        });

        // Soft delete na tabela users
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes()->after('remember_token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_access_logs');

        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
