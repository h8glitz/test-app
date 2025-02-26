<h1>Заказ #{{ $order->id }}</h1>
<p>ФИО: {{ $order->customer_name }}</p>
<p>Статус: {{ $order->status }}</p>
<p>Товар: {{ $order->product->name }} ({{ $order->product->price }} руб.)</p>
<p>Количество: {{ $order->quantity }}</p>
<p>Итоговая цена: {{ $order->total_price }} руб.</p>

@if($order->status === 'новый')
    <form action="{{ route('orders.complete', $order->id) }}" method="POST">
        @csrf
        <button type="submit">Отметить как выполнен</button>
    </form>
@endif
