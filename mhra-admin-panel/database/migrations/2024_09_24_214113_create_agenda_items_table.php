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
    Schema::create('agenda_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('agenda_id');
        $table->integer('day_number')->default(1);
        $table->time('start_time');
        $table->time('end_time');
        $table->string('title', 255);
        $table->text('description')->nullable();
        $table->unsignedBigInteger('speaker_id')->nullable();
        $table->integer('order')->nullable();
        $table->timestamps();

        $table->foreign('agenda_id')->references('id')->on('agendas')->onDelete('cascade');
        $table->foreign('speaker_id')->references('id')->on('speakers')->onDelete('set null');
    });
}

public function down()
{
    Schema::dropIfExists('agenda_items');
}

};
