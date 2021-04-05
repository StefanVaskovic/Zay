<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments("id");
            $table->foreignId("user_id");
            $table->foreignId('product_id');
            $table->text('text');
            $table->integer('likes')->default(0);
            $table->date('date');
            $table->foreignId('parent_id')->nullable();
            $table->foreignId('user_replied_id');

            //$table->foreign('parent_id')->references("user_id")->on("comments");
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
        Schema::dropIfExists('comments');
    }
}
