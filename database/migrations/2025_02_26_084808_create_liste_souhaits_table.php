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
        Schema::create('liste_souhaits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->decimal('prix_estime', 10, 2);
            $table->decimal('montant_actuel', 10, 2)->default(0);
            $table->enum('priorite', ['faible', 'moyenne', 'élevée']);
            $table->string('status')->default('pending');
            $table->timestamp('date_realisation')->nullable();
            $table->decimal('montant_realise', 10, 2)->nullable();
            $table->decimal('progression', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liste_souhaits');
    }
};
