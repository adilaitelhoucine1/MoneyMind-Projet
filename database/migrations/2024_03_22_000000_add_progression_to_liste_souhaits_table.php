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
    // Add the column only if it doesn't already exist
    Schema::table('liste_souhaits', function (Blueprint $table) {
        if (!Schema::hasColumn('liste_souhaits', 'progression')) {
            $table->decimal('progression', 5, 2)->default(0.00)->after('montant_realise');
        }
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liste_souhaits', function (Blueprint $table) {
            $table->dropColumn('progression');
        });
    }
}; 
