<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->text('excerpt');
            $table->string('title');
            $table->text('body');
            $table->string('slug')->unique();
            $table->string('image')->nullable();

            $table->timestamp('published_at')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('view_count')->default(0);

            $table->softDeletes();
            
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
