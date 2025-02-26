<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <label>ФИО покупателя</label>
    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required>

    <label>Комментарий</label>
    <textarea name="customer_comment">{{ old('customer_comment') }}</textarea>

    <label>Товар</label>
    <select name="product_id">
        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->price }} руб.)</option>
        @endforeach
    </select>

    <label>Количество</label>
    <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1">

    <label>Дата создания</label>
    <input type="date" name="created_date" value="{{ old('created_date') }}" required>

    <button type="submit">Создать заказ</button>
</form>
