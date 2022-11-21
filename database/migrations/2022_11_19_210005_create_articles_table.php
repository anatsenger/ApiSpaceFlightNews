<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_articles', function (Blueprint $table) {

            $table->id()->unique();
            $table->boolean('featured');
            $table->string('title');
            $table->string('url');
            $table->string('imageUrl')->nullable();
            $table->string('newsSite');
            $table->string('summary')->nullable();
            $table->string('publishedAt');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('articles', function (Blueprint $table) {

            $table->id()->unique();
            $table->boolean('featured');
            $table->string('title');
            $table->string('url');
            $table->string('imageUrl')->nullable();
            $table->string('newsSite');
            $table->string('summary')->nullable();
            $table->string('publishedAt');
            
            $table->timestamps();
            $table->softDeletes();

            
        });

        Schema::create('launches', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('provider');
            $table->unsignedBigInteger('article_id');

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('provider');
            $table->unsignedBigInteger('article_id');
            $table->uuid('launches_id');

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('launches_id')->references('id')->on('launches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_articles');
        Schema::dropIfExists('lauches');
        Schema::dropIfExists('events');
        Schema::dropIfExists('articles');
    }
};
