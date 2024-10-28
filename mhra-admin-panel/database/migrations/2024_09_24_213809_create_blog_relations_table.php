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
    Schema::create('blog_relations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('blog_id');
        $table->unsignedBigInteger('related_blog_id');
        $table->timestamps();

        $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        $table->foreign('related_blog_id')->references('id')->on('blogs')->onDelete('cascade');
        $table->unique(['blog_id', 'related_blog_id']);
    });
}

public function down()
{
    Schema::dropIfExists('blog_relations');
}

};
