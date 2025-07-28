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
        Schema::create('livries', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('publish_id')->constrained()->cascadeOnDelete();

            $table->string('quartier');
            $table->enum('ville', ['Ouagadougou', 'Bobo-Dioulasso', 'Koudougou', 'Fada N’Gourma', 'Banfora', 'Gaoua', 'Tenkodogo', 'Kaya', 'Ziniare']);
            $table->enum('status', ['en attente', 'en cours', 'complete'])->default('en attente');
            $table->string('phone', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livries');
    }
};
