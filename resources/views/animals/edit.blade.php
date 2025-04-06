@extends('layouts.app')

@section('title', 'Редактирование животного')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Редактировать животное: {{ $animal->name }}</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('animals.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Имя животного:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $animal->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="species">Вид:</label>
                        <input type="text" name="species" id="species" class="form-control" value="{{ old('species', $animal->species) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="age">Возраст:</label>
                        <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $animal->age) }}" required min="0">
                    </div>

                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea name="description" id="description" class="form-control" required>{{ old('description', $animal->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Изображение:</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if($animal->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $animal->image) }}" alt="Изображение {{ $animal->name }}" class="img-fluid" style="max-height: 200px; object-fit: cover;">
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Сохранить изменения</button>
                    <a href="{{ route('home', $animal->id) }}" class="btn btn-secondary mt-3">Отменить</a>
                </form>
            </div>
        </div>
    </div>
@endsection
