<?php

namespace App\Http\Controllers;

use App\Models\Cage;
use Illuminate\Http\Request;

class CageController extends Controller
{
    public function create()
    {
        return view('cages.create');
    }

    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        // Создание клетки
        Cage::create($validatedData);

        return redirect('/');
    }

    // Метод для редактирования клетки
    public function edit($id)
    {
        $cage = Cage::findOrFail($id);
        return view('cages.edit', compact('cage'));
    }

    // Метод для обновления клетки
    public function update(Request $request, $id)
    {
        // Находим клетку
        $cage = Cage::findOrFail($id);

        // Получаем количество животных в клетке
        $animalsCount = $cage->animals->count();



        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:' . $animalsCount, // Вместимость не может быть меньше количества животных
        ]);

        // Проверка, что вместимость не меньше количества животных
        if ($request->capacity < $animalsCount) {
            return redirect()->back()->withErrors(['capacity' => 'Новая вместимость клетки не может быть меньше количества животных!']);
        }

        // Обновляем клетку
        $cage->update($validatedData);

        return redirect()->route('home')->with('success', 'Информация о клетке успешно обновлена!')
            ->with('type', 'success');
    }

    // Метод для удаления клетки
    public function destroy($id)
    {
        // Находим клетку по ID
        $cage = Cage::findOrFail($id);

        // Проверяем, есть ли животные в клетке
        if ($cage->animals->count() > 0) {
            return redirect()->route('home')->with('success','Эта клетка не может быть удалена! В ней есть животные! Переселите их в свободную клетку')
                ->with('type','error');
        }

        // Удаляем клетку
        $cage->delete();

        return redirect()->route('home')->with('success', 'Клетка успешно удалена!')
            ->with('type', 'success');
    }
}
