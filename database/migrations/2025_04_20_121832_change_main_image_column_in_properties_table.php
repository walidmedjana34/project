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
        $table->text('main_image')->nullable()->change();
    });
}

public function down()
{
    Schema::table('properties', function (Blueprint $table) {
        $table->string('main_image', 255)->nullable()->change();
    });
}
};
