<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 產品類型資料表
        Schema::create('product_type', function (Blueprint $table) {
            $table->bigIncrements('id');                                // 唯一編號
            $table->char('uuid');                                       // UUID
            $table->string('name')->length(20);                         // 產品類型名稱
            $table->tinyInteger('is_delete')->length(1)->default(0);    // 是否刪除
            $table->unsignedBigInteger('create_by')->length(20);        // 建立者
            $table->dateTime('create_time');                            // 建立時間
            $table->unsignedBigInteger('modify_by')->length(20);        // 修改者
            $table->dateTime('modify_time');                            // 修改時間
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_type');
    }
}
