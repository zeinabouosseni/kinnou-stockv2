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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employe_id')->unique()->constrained('employes')->onDelete('cascade');
            $table->boolean('enregistrer_ventes')->default(true);
            $table->boolean('voir_stock')->default(true);
            $table->boolean('gerer_depenses')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
