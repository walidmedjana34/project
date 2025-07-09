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
        Schema::table('properties', function (Blueprint $table) {
            $table->string('wilaya')->nullable();
            $table->string('commune')->nullable();
            $table->string('address')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('surface')->nullable();
            $table->json('features')->nullable();
            $table->string('main_image')->nullable(); // chemin de l'image principale
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'wilaya',
                'commune',
                'address',
                'bedrooms',
                'bathrooms',
                'surface',
                'features',
                'main_image'
            ]);
        });
    }
};
