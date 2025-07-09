<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vacances', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('localisation');
            $table->string('wilaya');
            $table->decimal('prix_nuit', 10, 2);
            $table->integer('chambres');
            $table->integer('salles_bain');
            $table->integer('capacite_max');
            $table->integer('superficie')->nullable();
            
            $table->enum('type', ['appartement', 'maison', 'villa', 'chalet']);
            $table->enum('type_annonce', ['location', 'vente'])->default('location');
            
            // Équipements
            $table->boolean('wifi')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('piscine')->default(false);
            $table->boolean('cuisine')->default(false);
            $table->boolean('television')->default(false);
            $table->boolean('climatisation')->default(false);
            
            // Images (stockage JSON)
            $table->json('images')->nullable();
            
            // Disponibilité
            $table->date('disponible_de')->nullable();
            $table->date('disponible_jusqua')->nullable();
            
            // Statut
            $table->enum('statut', ['disponible', 'reserve', 'loue'])->default('disponible');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vacances');
    }
};
