<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // Получаем клетку
        $cage = Cage::findOrFail($request->cage_id);

        // Проверяем, не превышает ли количество животных в клетке её вместимость
        if ($cage->animals->count() >= $cage->capacity) {
            return redirect()->back()->withErrors(['cage_full' => 'Эта клетка уже полна!']);
        }

        // Обработка и сохранение изображения
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->hashName();
            // Сохраняем изображение в папку 'public/animals' с уникальным именем
            $imagePath = $request->file('image')->storeAs('animals', $fileName, ['disk' => 'public']);
            $validatedData['image'] = $imagePath; // Сохраняем путь к изображению
        }

        // Создание животного
        Animal::create($validatedData);

        // Передаем уведомление с успешным сообщением
        return redirect()->route('home')->with('success', 'Животное успешно создано!')
            ->with('type', 'success');
    }

    // Метод для удаления животного
    public function destroy($id)
    {
        // Находим животное по ID
        $animal = Animal::findOrFail($id);

        // Удаляем изображение из хранилища, если оно существует
        if ($animal->image) {
            // Удаляем изображение из папки storage
            Storage::delete('public/animals/' . $animal->image);
        }

        // Сохраняем имя животного в сессии, чтобы отобразить его в уведомлении
        $animalName = $animal->name;

        // Удаляем животное из базы данных
        $animal->delete();

        // Передаем уведомление об успешном удалении животного
        return redirect()->route('home')->with('success', 'Животное "' . $animalName . '" успешно удалено!')
            ->with('type', 'error');
    }

}
