<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Отобразить список заказов.
     */
    public function index()
    {
        // Подгружаем связанные товары, чтобы вывести их названия и цены
        $orders = Order::with('product')->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Показать форму для создания нового заказа.
     */
    public function create()
    {
        // Получаем список товаров
        $products = Product::all();

        return view('orders.create', compact('products'));
    }

    /**
     * Сохранить новый заказ.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_comment' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'created_date' => 'required|date',
        ]);

        Order::create($data);

        return redirect()->route('orders.index')
            ->with('success', 'Заказ успешно создан!');
    }

    /**
     * Показать конкретный заказ.
     */
    public function show(Order $order)
    {
        // Подгружаем товар
        $order->load('product');

        return view('orders.show', compact('order'));
    }

    /**
     * Форма редактирования (необязательно, если требуется).
     * По условию задания можно не редактировать заказ, а только статус.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Обновить данные о заказе (если нужно).
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Удалить заказ (необязательно по условию, но может пригодиться).
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Метод для смены статуса заказа на "выполнен".
     */
    public function complete(Order $order)
    {
        $order->update(['status' => 'выполнен']);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Статус заказа изменён на "выполнен"!');
    }
}
