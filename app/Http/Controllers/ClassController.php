<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with('classes')->get(); 
        return view('theme.classes.index', compact('grades'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::all();
        return view('theme.classes.createclass', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
        ]);

        Classes::create([
            'name' => [
                'en' => $validated['name_en'],
                'ar' => $validated['name_ar'],
            ],
            'grade_id' => $validated['grade_id'],
        ]);

        session()->flash('success', 'Class added successfully');

        return redirect()->route('theme.classes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = Classes::findOrFail($id);
        $grades = Grade::all(); // تحميل جميع المراحل الدراسية

        return view('theme.classes.updateclass', compact('class', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
        ]);

        $class = Classes::findOrFail($id);

        $class->setTranslations('name', [
            'en' => $validated['name_en'],
            'ar' => $validated['name_ar'],
        ]);

        $class->grade_id = $validated['grade_id']; 
        $class->save();

        return redirect()->route('theme.classes.index')
            ->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        return redirect()->route('theme.classes.index')->with('success', 'Grade deleted successfully.');
    }
}
