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
    Schema::create('candidatures', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->string('entreprise');
    $table->string('poste');
    $table->string('url_offre')->nullable();

    $table->string('statut')->default('candidature_envoyee');
    $table->string('priorite')->default('moyenne');

    $table->text('notes')->nullable();

    $table->date('date_candidature')->useCurrent();

    $table->string('cv_path')->nullable();

    $table->softDeletes();
    $table->timestamps();


    $table->index('statut');
    $table->index('priorite');
    $table->index('date_candidature');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
