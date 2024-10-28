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
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('first_name', 50);
        $table->string('last_name', 50);
        $table->string('title', 100)->nullable();
        $table->text('bio')->nullable();
        $table->string('photo_url', 255)->nullable();
        $table->json('social_links')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('employees');
}

};
