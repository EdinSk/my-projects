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
    Schema::create('blog_comment_likes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('comment_id');
        $table->unsignedBigInteger('user_id');
        $table->timestamps();

        $table->foreign('comment_id')->references('id')->on('blog_comments')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->unique(['comment_id', 'user_id']);
    });
}

public function down()
{
    Schema::dropIfExists('blog_comment_likes');
}

};
