<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('specialist')->get();
        return view('theme.teacher.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialists=Specialist::all();
        return view('theme.teacher.Add_teacher',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'Email' => 'required|email|unique:teachers,Email',
            'Password' => 'required|string|min:6', 
            'Joining_Date' => 'required|date',
            'Address' => 'required|string',
            'Gender' => 'required|in:male,female',
            'Specialists_id' => 'required|exists:specialists,id',
        ]);
        $teacher = new \App\Models\Teacher();

       
        $teacher->name = $validated['name'];
        $teacher->Email = $validated['Email'];
        $teacher->Password = Hash::make($validated['Password']);
        $teacher->Joining_Date = $validated['Joining_Date'];
        $teacher->Address = $validated['Address'];
        $teacher->Gender = $validated['Gender']; // 'male' أو 'female' حسب enum
        $teacher->Specialists_id = $validated['Specialists_id'];

        $teacher->save();
        return redirect()->route('theme.teacher.index')->with('success', 'Teacher added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id); // جلب بيانات المعلم
        $specialists = Specialist::all();    // جلب التخصصات
        return view('theme.teacher.updateclass', compact('teacher', 'specialists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'Email' => 'required|email|unique:teachers,Email,' . $id,
            'Joining_Date' => 'required|date',
            'Address' => 'required|string',
            'Gender' => 'required|in:male,female',
            'specialist_id' => 'required|exists:specialists,id',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update([
            'name' => $request->name,
            'Email' => $request->Email,
            'Joining_Date' => $request->Joining_Date,
            'Address' => $request->Address,
            'Gender' => $request->Gender,
            'specialist_id' => $request->specialist_id,
        ]);

        return redirect()->route('theme.teacher.index')->with('success', 'Teacher updated successfully');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('theme.teacher.index')->with('success', 'Teacher deleted successfully');
    }
}
