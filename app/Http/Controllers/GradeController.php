<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades=Grade::all();
        return view('theme.grade.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('theme.grade.creategrade');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name_en' => 'required|string|max:255|unique:grades,name->en',
            'name_ar' => 'required|string|max:255|unique:grades,name->ar',
            'notes'   => 'required|string',
        ]);
        Grade::create([
            'name' => [
                'en' => $validated['name_en'],
                'ar' => $validated['name_ar'],
            ],
            'notes' => $validated['notes'],
        ]);

        session()->flash('success', __('keyworld.added_successfully'));

        return redirect()->route('theme.Grade.index');
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
        $grade=Grade::find($id);
        return view('theme.grade.updategrade',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $grade = Grade::findOrFail($id);
        $grade->setTranslations('name', [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ]);
        $grade->notes = $request->notes;
        $grade->save();

        return redirect()->route('theme.Grade.index')->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);

        // التحقق إذا فيه أي كلاس مرتبط بالصف
        $hasClass = Classes::where('grade_id', $id)->exists();

        if ($hasClass) {
            return redirect()->route('theme.Grade.index')
                ->with('success', 'Cannot delete this grade because it has related classes.');
        }

        $grade->delete();

        return redirect()->route('theme.Grade.index')
            ->with('success', 'Grade deleted successfully.');
    }
}
