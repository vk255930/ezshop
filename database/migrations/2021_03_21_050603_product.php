<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 產品資料表
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');                                // 唯一編號
            $table->char('uuid');                                       // UUID
            $table->unsignedInteger('product_type_id')->length(10);     // 產品類別唯一編號
            $table->string('name')->length(50);                         // 產品名稱
            $table->decimal('amount', 12, 2);                           // 產品金額
            $table->text('img_path')->text(200)->nullable();            // 照片
            $table->text('description')->length(200)->nullable();       // 備註
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
        Schema::dropIfExists('product');
    }
}
