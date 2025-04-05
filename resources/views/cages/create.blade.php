@extends('layouts.app')

@section('title', 'Добавить клетку')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Создание клетки для животных</h1>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card" style="width: 30rem; height: 20rem">
                    <div class="card-body">
                        <form action="{{ route('cages.store') }}" method="POST">
                            @csrf

                            <div class="form-group fs-4">
                                <label for="name">Название клетки:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group fs-4 mt-4">
                                <label for="capacity">Вместимость клетки:</label>
                                <input type="number" name="capacity" id="capacity" class="form-control" required min="1">
                            </div>

                            <button type="submit" class="btn btn-success btn-block mt-5">Создать клетку</button>
                        </form>
                    </div>
                </div>

                <br>
                <a href="{{ route('home') }}" class="btn btn-primary btn-block">Назад к главной странице</a>
            </div>
        </div>
    </div>
@endsection
