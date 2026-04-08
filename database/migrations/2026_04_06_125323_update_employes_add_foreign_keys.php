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
        Schema::table('employes', function (Blueprint $table) {
            // Если старые текстовые поля есть — удаляем их
            if (Schema::hasColumn('employes', 'position')) {
                $table->dropColumn('position');
            }
            if (Schema::hasColumn('employes', 'departement')) {
                $table->dropColumn('departement');
            }
            $table->foreignId('position_id')->nullable()->constrained('positions')->cascadeOnDelete();
            $table->foreignId('departement_id')->nullable()->constrained('departements')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
        public function down(): void
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->string('position')->nullable();
            $table->string('departement')->nullable();

            $table->dropForeign(['position_id']);
            $table->dropForeign(['departement_id']);
            $table->dropColumn(['position_id', 'departement_id']);
        });
    }
    };

