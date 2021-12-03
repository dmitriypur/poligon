<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('preview')->nullable();
            $table->text('content');
            $table->string('image')->nullable();
            $table->boolean('publish')->nullable()->default(1);
            $table->boolean('favorite')->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->softDeletes();
            $table->integer('view_count')->nullable()->unsigned()->default(0);
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
