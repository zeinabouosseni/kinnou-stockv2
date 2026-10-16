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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boutique_id')->references('id')->on('boutiques')->cascadeOnDelete('cascade');
            $table->foreignId('categorie_id')->references('id')->on('categories');
            $table->string('nom');
            $table->decimal('prix_achat', 12, 2);
            $table->decimal('prix_vente', 12, 2);
            $table->integer('quantite')->default(0);
            $table->integer('seuil_alerte')->default(5);
            $table->string('unite');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
