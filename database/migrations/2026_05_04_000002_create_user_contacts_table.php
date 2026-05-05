<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type');        // ContactType enum
            $table->string('number');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        // Remove phone da tabela users (migrado para user_contacts)
        if (Schema::hasColumn('users', 'phone')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('user_contacts');

        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('company');
        });
    }
};
