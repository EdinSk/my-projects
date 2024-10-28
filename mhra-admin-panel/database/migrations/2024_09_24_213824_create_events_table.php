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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('title', 255);
        $table->string('theme', 255)->nullable();
        $table->text('description')->nullable();
        $table->text('objective')->nullable();
        $table->string('location', 255)->nullable();
        $table->dateTime('start_date')->nullable();
        $table->dateTime('end_date')->nullable();
        $table->string('event_type', 50);  // Added event_type
        $table->string('status', 50)->nullable();
        $table->string('hero_image_url', 255)->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('events');
}
};
