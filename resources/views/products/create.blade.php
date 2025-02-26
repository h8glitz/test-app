<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label>Название</label>
    <input type="text" name="name" value="{{ old('name') }}">

    <label>Категория</label>
    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <label>Описание</label>
    <textarea name="description">{{ old('description') }}</textarea>

    <label>Цена</label>
    <input type="number" step="0.01" name="price" value="{{ old('price') }}">

    <button type="submit">Создать</button>
</form>
