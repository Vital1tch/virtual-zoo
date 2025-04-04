<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить животное</title>
</head>
<body>
<h1>Создать животное</h1>

<!-- Форма для добавления животного -->
<form action="{{ route('animals.store') }}" method="POST">
    @csrf

    <label for="name">Имя животного:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="species">Вид:</label>
    <input type="text" name="species" id="species" required><br>

    <label for="age">Возраст:</label>
    <input type="number" name="age" id="age" required min="0"><br>

    <label for="description">Описание:</label>
    <textarea name="description" id="description" required></textarea><br>

    <label for="cage_id">Выберите клетку:</label>
    <select name="cage_id" id="cage_id" required>
        @foreach($cages as $cage)
            <option value="{{ $cage->id }}">{{ $cage->name }}</option>
        @endforeach
    </select><br>

    <button type="submit">Создать животное</button>
</form>

<br>
<a href="{{ route('animals.index') }}">Назад к животным</a>
</body>
</html>



