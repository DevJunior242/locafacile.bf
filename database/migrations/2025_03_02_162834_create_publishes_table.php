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
        Schema::create('publishes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('replicate_id')->nullable();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->text('titre');
            $table->enum('type_cour', ['commune', 'unique']);

            $table->enum('form_logement', ['appartement', 'villa_simple', 'villa_duplex', 'chambre_salon', 'entre_couche', 'studio', 'magasin', 'boutique']);
            $table->enum('type_sol', ['carrelée', 'cimentée']);

            $table->text('description')->nullable();
            $table->decimal('prix', 15, 2);
            $table->unsignedTinyInteger('avance');
            $table->unsignedTinyInteger('caution');
            $table->unsignedTinyInteger('nombre_chambres');
            $table->unsignedTinyInteger('nombre_salons');
            $table->unsignedTinyInteger('etage')->nullable();

            $table->enum('ville', ['Ouagadougou', 'Bobo-Dioulasso', 'Koudougou', 'Fada N’Gourma', 'Banfora', 'Gaoua', 'Tenkodogo', 'Kaya', 'Ziniare']);
            $table->string('quartier');
            $table->string('localisation')->nullable();
            $table->string('file');
            $table->string('path');

            $table->enum('douche', ['interne', 'externe', 'interne_et_externe']);
            $table->boolean('eau')->default(0);
            $table->boolean('plafonnée')->default(0);

            $table->boolean('courant')->default(0);
            $table->boolean('climatisation')->default(0);
            $table->boolean('garage_parking')->default(0);
            $table->boolean('jardin')->default(0);
            $table->boolean('ventilateur')->default(0);
            $table->boolean('balcon')->default(0);
            $table->boolean('terrasse')->default(0);
            $table->boolean('cuisine')->default(0);
            $table->boolean('meublée')->default(0);
            $table->boolean('internet')->default(0);
            $table->boolean('chateau_eau')->default(0);
            $table->enum('securite', ['gardient', 'barbeles', 'cloture', 'aucun'])->nullable();
            $table->enum('status', ['attente_de_verification', 'disponible', 'occupee', 'archive', 'in_progress'])->default('attente_de_verification');
            $table->fullText(['titre', 'quartier']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishes');
    }
};
