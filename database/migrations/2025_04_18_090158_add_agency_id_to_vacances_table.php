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
            $table->unsignedBigInteger('agency_id')->nullable()->after('id');
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
            
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
