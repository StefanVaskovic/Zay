<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments("id");
            $table->string("cover");
            $table->string("name");
/*            $table->decimal("old_price");*/
            $table->decimal("discount_price")->nullable();
            $table->decimal("current_price");
            $table->string("gender");
            $table->text("description");
            $table->string('color');
            $table->foreignId('category_id');
            $table->foreignId('brand_id');
            $table->tinyInteger('rate')->nullable();
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
        Schema::dropIfExists('products');
    }
}
