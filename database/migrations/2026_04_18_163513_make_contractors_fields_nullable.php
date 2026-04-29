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
        Schema::table('contractors', function (Blueprint $table) {
            $table->string('telephone')->nullable()->change();
            $table->string('adresse')->nullable()->change();
            $table->string('ville')->nullable()->change();
            $table->string('code_postal')->nullable()->change();
            $table->string('specialite')->nullable()->change();
            $table->string('nom_entreprise')->nullable()->change();
            $table->text('notes')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contractors', function (Blueprint $table) {
            $table->string('telephone')->nullable(false)->change();
            $table->string('adresse')->nullable(false)->change();
            $table->string('ville')->nullable(false)->change();
            $table->string('code_postal')->nullable(false)->change();
        });
    }
};
