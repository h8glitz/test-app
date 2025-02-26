<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Отобразить список товаров.
     */
    public function index()
    {
        // Получаем все товары с подгруженной категорией
        $products = Product::with('category')->get();

        // Возвращаем представление (для примера) или просто данные
        return view('products.index', compact('products'));
    }

    /**
     * Показать форму создания товара.
     */
    public function create()
    {
        // Получаем список категорий для выбора
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Сохранить новый товар.
     */
    public function store(Request $request)
    {
        // Валидация
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Товар успешно создан!');
    }

    /**
     * Просмотр конкретного товара.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Показать форму редактирования товара.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Обновить данные о товаре.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Товар успешно обновлён!');
    }

    /**
     * Удалить товар.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Товар удалён!');
    }
}
