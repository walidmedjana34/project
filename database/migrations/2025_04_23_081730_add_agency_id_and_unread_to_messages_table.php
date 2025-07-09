<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
           
                  
            // Add unread column with default value
            $table->boolean('unread')
                  ->default(true)
                  ->after('agency_id');
        });
    }

    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop foreign key first
           
            // Then drop columns
            $table->dropColumn(['agency_id', 'unread']);
        });
    }
};