<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Grade;
use App\Models\Sections;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('theme.section.index', get_defined_vars());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('theme.section.createsection');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'status'=> 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'classes_id' => 'required|exists:classes,id',
        ]);
        $section = Sections::create([
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'grade_id' => $request->grade_id,
            'classes_id' => $request->classes_id,
            'status'=>$request->status,
        ]);

        return to_route('theme.sections.index')->with('success', 'تم إضافة sections بنجاح');
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
        $section=Sections::findorfail($id);
        return view('theme.section.updateclass',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'grade_id' => 'required|exists:grades,id',
            'classes_id' => 'required|exists:classes,id',
        ]);

        $section = Sections::findOrFail($id); 

        $section->update([
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'grade_id' => $request->grade_id,
            'classes_id' => $request->classes_id,
            'status' => $request->status,
        ]);

        return to_route('theme.sections.index')->with('success', 'Updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Sections::findOrFail($id);
        $section->delete();

        return redirect()->route('theme.sections.index')->with('success', 'Section deleted successfully');
    }
}
