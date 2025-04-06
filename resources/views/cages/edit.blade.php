@extends('layouts.app')

@section('title', 'Редактирование клетки')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Редактировать клетку: {{ $cage->name }}</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('cages.update', $cage->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Название клетки:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $cage->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Вместимость клетки:</label>
                        <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity', $cage->capacity) }}" required min="1">
                        @if($errors->has('capacity'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('capacity') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Сохранить изменения</button>
                    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Отменить</a>
                </form>
            </div>
        </div>
    </div>
@endsection
