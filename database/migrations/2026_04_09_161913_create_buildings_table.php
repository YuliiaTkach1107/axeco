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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('adresse');
            $table->string('ville');
            $table->string('code_postal');
            $table->integer('nombre_logements')->default(0);
            $table->integer('nombre_etages')->nullable();
            $table->year('annee_construction')->nullable();
            $table->string('nom_syndic')->nullable();
            $table->string('email_contact')->nullable();
            $table->string('telephone_contact')->nullable();
            $table->boolean('ascenseur')->default(false);
            $table->boolean('parking')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
