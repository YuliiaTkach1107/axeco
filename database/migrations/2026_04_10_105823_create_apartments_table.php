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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->foreignId('copropriete_id')->constrained('buildings')->cascadeOnDelete();
            $table->string('etage')->nullable();
            $table->integer('surface')->nullable();
            $table->integer('nombre_pieces')->nullable();
            $table->text('type');
            $table->enum('statut', ['libre', 'occupe', 'maintenance'])->default('libre');
            $table->boolean('balcon')->default(false);
            $table->boolean('parking')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
