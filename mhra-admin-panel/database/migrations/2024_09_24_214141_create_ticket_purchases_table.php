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
    Schema::create('ticket_purchases', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('event_id');
        $table->unsignedBigInteger('ticket_type_id');
        $table->decimal('price', 10, 2);
        $table->timestamp('purchase_date')->useCurrent();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        $table->foreign('ticket_type_id')->references('id')->on('event_ticket_types')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('ticket_purchases');
}

};
