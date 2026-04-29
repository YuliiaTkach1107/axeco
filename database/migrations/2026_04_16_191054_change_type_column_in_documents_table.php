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
        Schema::table('documents', function (Blueprint $table) {
        $table->dropColumn('type');
    });

    Schema::table('documents', function (Blueprint $table) {
        
        $table->enum('type', ['personal', 'building', 'public'])
              ->default('building')
              ->after('description');

        $table->enum('category', ['contrat', 'facture', 'reglement', 'pv_ag'])
              ->default('reglement')
              ->after('type');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['type', 'category']);
            $table->string('type')->nullable(); 
        });
    }
};
