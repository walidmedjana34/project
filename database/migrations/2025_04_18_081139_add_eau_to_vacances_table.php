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
        Schema::table('vacances', function (Blueprint $table) {
            $table->tinyInteger('eau')->default(0)->comment('0 = Pas d\'eau, 1 = Eau disponible, 2 = Mer, 3 = Piscine, etc.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacances', function (Blueprint $table) {
            //
        });
    }
};
