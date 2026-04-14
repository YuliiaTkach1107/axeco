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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('statut', [
                'ouvert',
                'en_cours',
                'résolu',
                'fermé',
            ])->default('ouvert');
            $table->enum('priorite', [
                'faible',
                'moyenne',
                'élevée',
                'urgente',
            ])->default('moyenne');
            $table->foreignId('resident_id')->constrained('residents')->cascadeOnDelete();
            $table->foreignId('building_id')->constrained('buildings')->cascadeOnDelete();
            $table->foreignId('apartment_id')->nullable()->constrained('apartments')->nullOnDelete();
            $table->foreignId('contractor_id')->nullable()->constrained('contractors')->nullOnDelete();
            $table->text('note_admin')->nullable();
            $table->timestamp('assigne_le')->nullable();
            $table->timestamp('resolu_le')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
