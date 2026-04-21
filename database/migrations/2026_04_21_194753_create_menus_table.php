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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('icon')->nullable()->comment('Classe do ícone Keenicons, ex: ki-filled ki-home-3');
            $table->string('route')->nullable()->comment('Nome da rota Laravel ou URL');
            $table->boolean('is_route')->default(true)->comment('true = route(), false = URL direta');
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('active')->default(true);
            $table->string('section')->nullable()->comment('Cabeçalho de seção, ex: Pages, Outline');
            $table->boolean('is_section_header')->default(false)->comment('Se true, é apenas um separador/título de seção');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
