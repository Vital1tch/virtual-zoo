@extends('layouts.app')

@section('title', 'Добавить животное')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Создание животного</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Имя животного -->
                            <div class="form-group fs-4">
                                <label for="name">Имя животного:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <!-- Вид животного -->
                            <div class="form-group fs-4 mt-4">
                                <label for="species">Вид:</label>
                                <input type="text" name="species" id="species" class="form-control" required>
                            </div>

                            <!-- Возраст животного -->
                            <div class="form-group fs-4 mt-4">
                                <label for="age">Возраст:</label>
                                <input type="number" name="age" id="age" class="form-control" required min="0">
                            </div>

                            <!-- Описание животного -->
                            <div class="form-group fs-4 mt-4">
                                <label for="description">Описание:</label>
                                <textarea name="description" id="description" class="form-control" required></textarea>
                            </div>

                            <!-- Клетка для животного -->
                            <div class="form-group fs-4 mt-4">
                                <label for="cage_id">Выберите клетку:</label>
                                <select name="cage_id" id="cage_id" class="form-control" required>
                                    @foreach($cages as $cage)
                                        <option value="{{ $cage->id }}">{{ $cage->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Загрузка изображения животного -->
                            <div class="form-group fs-4 mt-4">
                                <label for="image">Фотография животного:</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            </div>

                            <!-- Кнопка отправки формы -->
                            <button type="submit" class="btn btn-success btn-block mt-5">Создать животное</button>
                        </form>
                    </div>
                </div>

                <br>
                <a href="{{ route('home') }}" class="btn btn-primary btn-block">Назад к главной странице</a>
            </div>
        </div>
    </div>
@endsection
