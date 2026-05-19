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
       Schema::create('entretiens', function (Blueprint $table) {
    $table->id();

    $table->foreignId('candidature_id')->constrained()->cascadeOnDelete();

    $table->string('type'); 
    $table->string('categorie')->nullable();

    $table->dateTime('date_heure');

    $table->string('lieu')->nullable();

    $table->text('notes_preparation')->nullable();

    $table->string('resultat')->default('en_attente');

    $table->softDeletes();
    $table->timestamps();

   
    $table->index('date_heure');
    $table->index('resultat');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
