<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdatestudentRequest;
use App\Models\Classes;
use App\Models\classroom;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\National;
use App\Models\Religion;
use App\Models\Sections;
use App\Models\student;
use App\Models\StudentPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->with('classroom') 
            ->latest()
            ->paginate(10); 

        return view('theme.student.show', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::all();
        $Religions = Religion::all();
        $parents = MyParent::all();
        $Nationalities = National::all();


        return view('theme.student.index', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
       
        // التحقق من البيانات
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'national_id'   => 'required|max:20|unique:students,national_id',
            'email'         => 'required|email|max:255|unique:students,email',
            'password'      => 'required|string|min:6',
            'birth_date'    => 'required|date',
            'religion_id'   => 'required|exists:religions,id',
            'grade_id'      => 'required|exists:grades,id',
            'classroom_id'  => 'required|exists:classes,id',
            'section_id'    => 'required|exists:sections,id',
            'parent_id'     => 'required|exists:my_parents,id',
            'address'       => 'required|string',
        ]);
       
        // إنشاء الطالب
        Student::create([
            'name' => $validated['name'],
            'email'        => $validated['email'],
            'password'     => Hash::make($validated['password']),
            'national_id'  => $validated['national_id'],
            'birth_date'   => $validated['birth_date'],
            'religion_id'  => $validated['religion_id'],
            'grade_id'     => $validated['grade_id'],
            'classroom_id' => $validated['classroom_id'],
            'section_id'   => $validated['section_id'],
            'parent_id'    => $validated['parent_id'],
            'address'      => $validated['address'],
        ]);

        return redirect()->route('theme.student.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $search = $request->input('search');

        $students = Student::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->with('classroom') 
            ->latest()
            ->paginate(10); 

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::with(['classroom', 'section'])->findOrFail($id);

        $grades      = Grade::all();
        $classrooms  = Classes::where('grade_id', $student->grade_id)->get();
        $sections    = Sections::where('classes_id', $student->classroom_id)->get();
        $parents     = MyParent::all();
        $Religions   = Religion::all();

        return view('theme.student.edit', compact(
            'student',
            'grades',
            'classrooms',
            'sections',
            'parents',
            'Religions'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'national_id'  => 'required|numeric',
            'email'        => 'required|email|unique:students,email,' . $id,
            'password'     => 'nullable|min:6',
            'birth_date'   => 'required|date',
            'religion_id'  => 'required|integer',
            'grade_id'     => 'required|integer',
            'classroom_id' => 'required|integer',
            'section_id'   => 'required|integer',
            'parent_id'    => 'required|integer',
            'address'      => 'required|string',
        ]);

        $student = Student::findOrFail($id);

        $student->name         = $request->name;
        $student->national_id  = $request->national_id;
        $student->email        = $request->email;
        if ($request->filled('password')) {
            $student->password = bcrypt($request->password);
        }
        $student->birth_date   = $request->birth_date;
        $student->religion_id  = $request->religion_id;
        $student->grade_id     = $request->grade_id;
        $student->classroom_id = $request->classroom_id;
        $student->section_id   = $request->section_id;
        $student->parent_id    = $request->parent_id;
        $student->address      = $request->address;

        $student->save();

        return redirect()->route('theme.student.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        $student = student::findOrFail($student->id);
        $student->delete();

        return redirect()->route('theme.student.index')->with('success', 'Student deleted successfully');
    }
    public function getClassrooms($grade_id)
    {
        $classrooms = Classes::where('grade_id', $grade_id)
            ->get()
            ->map(function ($classroom) {
                return [
                    'id'   => $classroom->id,
                    'name' => $classroom->name[app()->getLocale()] ?? '',
                ];
            });

        return response()->json($classrooms);
    }

    public function getSections($classroom_id)
    {
        $sections = Sections::where('classes_id', $classroom_id)
            ->get()
            ->map(function ($section) {
                return [
                    'id'   => $section->id,
                    'name' => $section->name[app()->getLocale()] ?? ''
                ];
            });

        return response()->json($sections);
    }
    public function student_promrtion($id)
    {
        $student    = Student::find($id);
        $grades     = Grade::all();
        $classrooms = Classes::all();
        $sections   = Sections::all();
        $promotions = StudentPromotion::with(['student', 'fromGrade', 'toGrade', 'fromClassroom', 'toClassroom', 'fromSection', 'toSection'])->get();

        return view('theme.student.student_promotion', compact(
            'student',
            'grades',
            'classrooms',
            'sections',
            'promotions'
        ));
    }
    public function Store_promotion(Request $request)
    {

       
        $request->validate([
            'student_id'          => 'required|exists:students,id',
            'from_grade'          => 'required',
            'to_grade'            => 'required',
            'from_classroom'      => 'required',
            'to_classroom'        => 'required',
            'from_section'        => 'required',
            'to_section'          => 'required',
            'from_academic_year'  => 'required',
            'to_academic_year'    => 'required',
        ]);
        

        DB::beginTransaction();

        try {
            // إنشاء سجل الترقية
            StudentPromotion::updateOrCreate(
                [
                    'student_id'         =>  $request->student_id,
                ],[
                'student_id'         => $request->student_id,
                'from_grade'         => $request->from_grade,
                'to_grade'           => $request->to_grade,
                'from_classroom'     => $request->from_classroom,
                'to_classroom'       => $request->to_classroom,
                'from_section'       => $request->from_section,
                'to_section'         => $request->to_section,
                'from_academic_year' => $request->from_academic_year,
                'to_academic_year'   => $request->to_academic_year,
            ]);

            // تحديث بيانات الطالب
            Student::where('id', $request->student_id)->update([
                'grade_id'     => $request->to_grade,
                'classroom_id' => $request->to_classroom,
                'section_id'   => $request->to_section,
            ]);

            DB::commit();

            return to_route('theme.student.index')->with('success', 'Student promoted successfully!');
        } catch (\Exception $e) {
            // لو حصلت مشكلة rollback
            DB::rollBack();

            return redirect()->back()->with('error', 'Promotion failed: ' . $e->getMessage());
        }
    }
    public function Section_promrtion(Request $request)
    {
        $grades     = Grade::all();
        $classrooms = Classes::all();
        $sections   = Sections::all();
        $promotions = StudentPromotion::with(['student', 'fromGrade', 'toGrade', 'fromClassroom', 'toClassroom', 'fromSection', 'toSection'])->get();

        return view('theme.student.section_promotion', compact(
            'grades',
            'classrooms',
            'sections',
            'promotions'
        ));


    }
    public function Store_Section_promotion(Request $request)
    {
        $request->validate([
            'from_grade'          => 'required',
            'to_grade'            => 'required',
            'from_classroom'      => 'required',
            'to_classroom'        => 'required',
            'from_section'        => 'required',
            'to_section'          => 'required',
            'from_academic_year'  => 'required',
            'to_academic_year'    => 'required',
        ]);
        $students=student::where('grade_id',$request->from_grade)
            ->where('classroom_id', $request->from_classroom)
            ->where('section_id', $request->from_section)
            ->get();
        foreach ($students as $student) {
            StudentPromotion::updateOrCreate(
                [
                    'student_id'         => $student->id,
                ],
                [
                'student_id'         => $student->id,
                'from_grade'         => $request->from_grade,
                'to_grade'           => $request->to_grade,
                'from_classroom'     => $request->from_classroom,
                'to_classroom'       => $request->to_classroom,
                'from_section'       => $request->from_section,
                'to_section'         => $request->to_section,
                'from_academic_year' => $request->from_academic_year,
                'to_academic_year'   => $request->to_academic_year,
            ]);

            // تحدث بيانات الطالب نفسه
            $student->update([
                'grade_id'     => $request->to_grade,
                'classroom_id' => $request->to_classroom,
                'section_id'   => $request->to_section,
            ]);
            return to_route('theme.student.index')->with('success', 'Student promoted successfully!');
        }
        

    }

}

