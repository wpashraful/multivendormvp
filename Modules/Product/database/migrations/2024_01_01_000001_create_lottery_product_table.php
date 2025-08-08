<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lottery_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('lottery_id');
            $table->timestamps();

            $table->unique(['product_id', 'lottery_id']);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('lottery_id')->references('id')->on('lotteries')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lottery_product');
    }
};
