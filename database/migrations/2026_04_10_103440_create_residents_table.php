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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->foreignId('copropriete_id')->constrained('buildings')->cascadeOnDelete();
            $table->foreignId('appartement_id')->constrained('apartments')->cascadeOnDelete();
            $table->enum('role', ['proprietaire', 'locataire']);
            $table->date('date_entre')->nullable();
            $table->date('date_sortie')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
