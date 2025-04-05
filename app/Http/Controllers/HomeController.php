<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Получаем все клетки с животными
        $cages = Cage::with('animals')->get();

        // Получаем общее количество животных
        $totalAnimals = Animal::count(); // Общее количество животных в зоопарке

        return view('welcome', compact('cages', 'totalAnimals')); // Передаем данные в blade
    }
}
