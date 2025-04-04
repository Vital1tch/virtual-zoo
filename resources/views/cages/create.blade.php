<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить клетку</title>
</head>
<body>
<h1>Создать клетку для животных</h1>

<!-- Форма для добавления клетки -->
<form action="{{ route('cages.store') }}" method="POST">
    @csrf

    <label for="name">Название клетки:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="capacity">Вместимость клетки:</label>
    <input type="number" name="capacity" id="capacity" required min="1"><br>

    <button type="submit">Создать клетку</button>
</form>

<br>
<a href="{{ route('cages.index') }}">Назад к клеткам</a>
</body>
</html>
