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
    Schema::create('speakers', function (Blueprint $table) {
        $table->id();
        $table->string('first_name', 50);
        $table->string('last_name', 50);
        $table->string('title', 100)->nullable();
        $table->text('bio')->nullable();
        $table->string('photo_url', 255)->nullable();
        $table->string('facebook_url', 255)->nullable();
        $table->string('linkedin_url', 255)->nullable();
        $table->string('instagram_url', 255)->nullable();
        $table->string('x_url', 255)->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('speakers');
}

};
