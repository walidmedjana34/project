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
        Schema::table('vacances', function (Blueprint $table) {
            // First, ensure the column is string type (if it's currently array)
            $table->text('main_image')->nullable()->change();
            
            // Then convert existing data to JSON format
            \DB::statement('UPDATE vacances SET main_image = CASE 
                WHEN main_image IS NOT NULL THEN JSON_ARRAY(main_image) 
                ELSE NULL END');
                
            // Finally change the column type to JSON
            $table->json('main_image')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('vacances', function (Blueprint $table) {
            // Convert back to text if rolling back
            $table->text('main_image')->nullable()->change();
        });
    }
};
