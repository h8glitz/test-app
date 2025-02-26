<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');      // Название товара
            $table->text('description')->nullable();  // Описание (необязательно)
            $table->unsignedBigInteger('category_id'); // Связь с категорией
            $table->decimal('price', 10, 2); // Цена с копейками
            $table->timestamps();

            // Создаём внешний ключ на таблицу categories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
