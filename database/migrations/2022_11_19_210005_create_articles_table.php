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

            
        });

        Schema::create('articles', function (Blueprint $table) {

            $table->id()->unique();
            $table->boolean('featured');
            $table->string('title');
            $table->string('url');
            $table->string('imageUrl')->nullable();
            $table->string('newsSite');
            $table->text('summary');
            $table->string('publishedAt');
            

            
        });

        Schema::create('launches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
    
        });
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            
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
