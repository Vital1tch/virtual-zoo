<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function create()
    {
        $cages = Cage::all(); // Получаем все клетки для отображения в выпадающем списке
        return view('animals.create', compact('cages'));
    }

    // Метод для сохранения животного
    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'required|string|max:1000',
            'cage_id' => 'required|exists:cages,id', // Проверка существования клетки
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Валидация для изображения
        ]);

        // Обработка и сохранение изображения
        if ($request->hasFile('image')) {
            // Сохраняем изображение в папку 'public/animals' с уникальным именем
            $imagePath = $request->file('image')->store('public/animals');
            $validatedData['image'] = $imagePath; // Сохраняем путь к изображению
        }

        // Создание животного
        Animal::create($validatedData);

        return redirect()->route('home');
    }
}
