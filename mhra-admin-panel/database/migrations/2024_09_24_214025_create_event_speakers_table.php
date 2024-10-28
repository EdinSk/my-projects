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
    Schema::create('event_speakers', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('event_id');
        $table->unsignedBigInteger('speaker_id');
        $table->string('speaker_type', 50)->nullable();
        $table->integer('order')->nullable();
        $table->timestamps();

        $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        $table->foreign('speaker_id')->references('id')->on('speakers')->onDelete('cascade');
        $table->unique(['event_id', 'speaker_id']);
    });
}

public function down()
{
    Schema::dropIfExists('event_speakers');
}

};
