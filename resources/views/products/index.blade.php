<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Список товаров</h1>

    @if($products->count())
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Категория</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name ?? '—' }}</td>
                        <td>
                            <a href="{{ route('products.show', $product) }}">Просмотр</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Товаров нет.</p>
    @endif

    <a href="{{ route('products.create') }}">Добавить товар</a>
@endsection
