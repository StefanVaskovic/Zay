<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER `tr_Product_Rate` AFTER INSERT ON `product_user` FOR EACH ROW
        BEGIN
            DECLARE idProduct INT;
            DECLARE rate INT;
            SET @idProduct = NEW.product_id;
            SET @rate = (select sum(grade) from product_user where product_id = @idProduct)/ (select count(*) from product_user where product_id = @idProduct);
            UPDATE products SET rate = @rate WHERE id=@idProduct;
        END
        ');

       /* DB::unprepared('
        CREATE TRIGGER `tr_Product_Rate_Update` AFTER UPDATE ON `product_user` FOR EACH ROW
        BEGIN
            DECLARE idProduct INT;
            DECLARE rate INT;
            SET @idProduct = NEW.product_id;
            SET @rate = (select sum(grade) from product_user where product_id = @idProduct)/ (select count(*) from product_user where product_id = @idProduct);
            UPDATE products SET rate = @rate WHERE id=@idProduct;
        END');*/
    }


    //sintaksa za proceduru CREATE PROCEDURE updateRate (IN idp INT) BEGIN UPDATE products SET rate = (select sum(grade) from product_user where product_id = idp)/ (select count(*) from product_user where product_id = idp) WHERE id = idp; END
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS`tr_Product_Rate`');
        /*DB::unprepared('DROP TRIGGER `tr_Product_Rate_Update`');*/
    }
}
