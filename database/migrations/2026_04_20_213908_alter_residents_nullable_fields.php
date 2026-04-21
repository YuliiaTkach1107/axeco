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
        Schema::table('residents', function (Blueprint $table) {
            $table->string('telephone')->nullable()->change();
            $table->foreignId('copropriete_id')->nullable()->change();
            $table->foreignId('appartement_id')->nullable()->change();
            $table->enum('role', ['proprietaire', 'locataire'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->string('telephone')->nullable(false)->change();
            $table->foreignId('copropriete_id')->nullable(false)->change();
            $table->foreignId('appartement_id')->nullable(false)->change();
            $table->enum('role', ['proprietaire', 'locataire'])->nullable(false)->change();
        });
    }
};
