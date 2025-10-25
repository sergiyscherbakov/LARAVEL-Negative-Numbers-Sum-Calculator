<?php

namespace App\Http\Controllers;

use App\Models\Number;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $numbers = Number::orderBy('created_at', 'desc')->get();
        $negativeSum = Number::where('value', '<', 0)->sum('value');

        return view('numbers.index', compact('numbers', 'negativeSum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('numbers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'value' => 'required|numeric'
        ]);

        Number::create($validated);

        return redirect()->route('numbers.index')
            ->with('success', 'Число успішно додано!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Number $number)
    {
        return view('numbers.show', compact('number'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Number $number)
    {
        return view('numbers.edit', compact('number'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Number $number)
    {
        $validated = $request->validate([
            'value' => 'required|numeric'
        ]);

        $number->update($validated);

        return redirect()->route('numbers.index')
            ->with('success', 'Число успішно оновлено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Number $number)
    {
        $number->delete();

        return redirect()->route('numbers.index')
            ->with('success', 'Число успішно видалено!');
    }

    /**
     * Generate random numbers
     */
    public function generateRandom(Request $request)
    {
        $count = $request->input('count', 10);

        for ($i = 0; $i < $count; $i++) {
            $value = rand(-10000, 10000) / 100; // Генерація від -100.00 до 100.00
            Number::create(['value' => $value]);
        }

        return redirect()->route('numbers.index')
            ->with('success', "Згенеровано {$count} випадкових чисел!");
    }
}
