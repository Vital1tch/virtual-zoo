@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <h1 class="my-4 text-center">Добро пожаловать в виртуальный зоопарк!</h1>

    <!-- Статистика о животных -->
    <section class="my-5 fs-4 fw-bold">
        <p>На данный момент в зоопарке <strong>{{ $totalAnimals }}</strong> животных.</p>
    </section>

    <!-- Список клеток -->
    <section class="my-2">
        <h3>Клетки:</h3>
        <div class="row">
            @foreach($cages as $cage)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cage->name }}</h5>
                            <p class="card-text">Вместимость: {{ $cage->capacity }}</p>
                            <p class="card-text">Животных в клетке: {{ $cage->animals->count() }}</p>

                            <!-- Кнопка для открытия модального окна с животными -->
                            <button class="btn btn-success" data-toggle="modal" data-target="#animalsModal{{ $cage->id }}">
                                Посмотреть животных
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Модальное окно для каждого животного в клетке -->
                <div class="modal fade" id="animalsModal{{ $cage->id }}" tabindex="-1" role="dialog" aria-labelledby="animalsModalLabel{{ $cage->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header justify-content-between">
                                <h5 class="modal-title" id="animalsModalLabel{{ $cage->id }}">Животные в клетке "{{ $cage->name }}"</h5>
                                <button type="button" class="close bg-secondary text-light" style="height: 3rem; width: 3rem" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Список животных -->
                                @foreach($cage->animals as $animal)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $animal->name }}</h5>
                                            <p class="card-text"><strong>Вид:</strong> {{ $animal->species }}</p>
                                            <p class="card-text"><strong>Возраст:</strong> {{ $animal->age }} лет</p>
                                            <p class="card-text"><strong>Описание:</strong> {{ $animal->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary border-black p-2 border-opacity-75" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>



    <div class="text-center">
        <a href="{{ route('cages.create') }}" class="add-cage">Добавить клетку</a>
        <a href="{{ route('animals.create') }}" class="btn btn-warning">Добавить животное</a>
    </div>
@endsection

