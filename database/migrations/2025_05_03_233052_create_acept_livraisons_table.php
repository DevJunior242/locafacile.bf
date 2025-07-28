<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acept_livraisons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('livrie_id')->constrained('livries')->cascadeOnDelete();
            $table->foreignUuid('livreur_id')->constrained('livreurs')->cascadeOnDelete();
            $table->enum('status', ['accept','effectue'])->default('accept');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acept_livraisons');
    }
};
