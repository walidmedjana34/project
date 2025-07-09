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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->text('location');
            $table->enum('type', [
                'appartement',
                'bungalow',
                'carcasse',
                'niveux_de_willya',
                'villa',
                'immeuble',
                'local',
                'hungar',
                'terrain',
                'bureaux_et_locaux',
                'salle_fetes',
                'garage_parking',
                'chalet',
                'studio',
                'commercial'
            ]);
            $table->enum('status', ['available', 'sold', 'rented'])->default('available');
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
