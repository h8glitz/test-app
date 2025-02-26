<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name'); // ФИО покупателя
            $table->text('customer_comment')->nullable(); // Комментарий покупателя
            $table->unsignedBigInteger('product_id'); // Выбранный товар
            $table->unsignedInteger('quantity')->default(1); // Количество
            $table->enum('status', ['новый', 'выполнен'])->default('новый'); // Статус
            $table->date('created_date'); // Дата создания (или datetime)
            $table->timestamps();

            // Внешний ключ на таблицу products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
