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
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
            $table->string('bio', 500)->nullable()->after('avatar');
            $table->string('job_title')->nullable()->after('bio');
            $table->string('company')->nullable()->after('job_title');
            $table->string('phone')->nullable()->after('company');
            $table->string('location')->nullable()->after('phone');
            $table->string('website')->nullable()->after('location');
            $table->string('linkedin')->nullable()->after('website');
            $table->string('github')->nullable()->after('linkedin');
            $table->string('twitter')->nullable()->after('github');
            $table->string('instagram')->nullable()->after('twitter');
            $table->boolean('profile_public')->default(true)->after('instagram');
            $table->boolean('show_email')->default(false)->after('profile_public');
            $table->boolean('show_phone')->default(false)->after('show_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar',
                'bio',
                'job_title',
                'company',
                'phone',
                'location',
                'website',
                'linkedin',
                'github',
                'twitter',
                'instagram',
                'profile_public',
                'show_email',
                'show_phone',
            ]);
        });
    }
};
