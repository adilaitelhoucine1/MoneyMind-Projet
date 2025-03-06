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
        Schema::table('liste_souhaits', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('prix_estime');
            $table->timestamp('date_realisation')->nullable()->after('status');
            $table->decimal('montant_realise', 10, 2)->nullable()->after('date_realisation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('liste_souhaits', function (Blueprint $table) {
            $table->dropColumn(['status', 'date_realisation', 'montant_realise']);
        });
    }
};