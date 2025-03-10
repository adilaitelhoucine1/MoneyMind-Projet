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
    // Check if the table exists and create it if not
    if (!Schema::hasTable('liste_souhaits')) {
        Schema::create('liste_souhaits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nom');
            $table->decimal('prix_estime', 10, 2);
            $table->string('status')->default('pending');
            $table->timestamp('date_realisation')->nullable();
            $table->decimal('montant_realise', 10, 2)->nullable();
            $table->decimal('progression', 5, 2)->default(0.00);
            $table->enum('priorite', ['faible', 'moyenne', 'élevée']);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    // Now add the additional columns
    Schema::table('liste_souhaits', function (Blueprint $table) {
        if (!Schema::hasColumn('liste_souhaits', 'status')) {
            $table->string('status')->default('pending')->after('prix_estime');
        }
        if (!Schema::hasColumn('liste_souhaits', 'date_realisation')) {
            $table->timestamp('date_realisation')->nullable()->after('status');
        }
        if (!Schema::hasColumn('liste_souhaits', 'montant_realise')) {
            $table->decimal('montant_realise', 10, 2)->nullable()->after('date_realisation');
        }
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
