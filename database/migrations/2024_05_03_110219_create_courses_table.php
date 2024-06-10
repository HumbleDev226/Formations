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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('titre');
            $table->string('description');
            $table->string('modules');
            $table->string('categorie');
            $table->string('auteur');
            $table->string('prix');
            $table->date('date');
            $table->string('fichier');
            $table->foreign('categorie')->references('nom')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
