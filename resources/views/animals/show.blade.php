@extends('layouts.app')

@section('title', 'Информация о животном')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Информация о животном: {{ $animal->name }}</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $animal->name }}</h5>
                <p class="card-text"><strong>Вид:</strong> {{ $animal->species }}</p>
                <p class="card-text"><strong>Возраст:</strong> {{ $animal->age }} лет</p>
                <p class="card-text"><strong>Описание:</strong> {{ $animal->description }}</p>

                <!-- Вывод изображения животного -->
                @if($animal->image)
                    <div class="animal-image mb-4">
                        <img src="{{ asset('storage/' . $animal->image) }}" alt="Изображение {{ $animal->name }}" class="img-fluid" style="max-height: 300px; object-fit: cover;">
                    </div>
                @else
                    <p class="text-muted">Изображение не доступно</p>
                @endif

                <!-- Кнопка для редактирования животного -->
                <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-warning mt-2">Редактировать</a>

                <!-- Кнопка для возврата назад -->
                <a href="{{ route('home') }}" class="btn btn-primary mt-2 ms-4">Назад</a>
            </div>
        </div>
    </div>
@endsection
