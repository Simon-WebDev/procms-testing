<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
           $table->increments('id');
           $table->string('title');
           $table->string('slug')->unique();
           $table->text('body');
           $table->string('image1')->nullable();
           $table->string('image2')->nullable();
           $table->integer('user_id')->unsigned();
           $table->integer('group_id')->unsigned();
           $table->integer('is_active')->nullable()->default(1);
           $table->integer('view_count')->nullable()->default(0);


           $table->timestamps();

           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           /*post, pages에선 cascade가 아니고 restrict로 고로 user 삭제시 관계된 post와 pages의 처리를 작성함. board에선 cascade로 */
           $table->foreign('group_id')->references('id')->on('groups')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
}
