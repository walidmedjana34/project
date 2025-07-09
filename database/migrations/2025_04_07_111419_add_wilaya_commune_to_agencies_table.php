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
        Schema::table('agencies', function (Blueprint $table) {
            $table->string('wilaya')->nullable()->after('address');
            $table->string('commune')->nullable()->after('wilaya');
            
            // If you want to add foreign key constraints (assuming wilayas and communes tables exist):
            // $table->foreignId('wilaya_id')->nullable()->constrained('wilayas');
            // $table->foreignId('commune_id')->nullable()->constrained('communes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agencies', function (Blueprint $table) {
            //
        });
    }
};
