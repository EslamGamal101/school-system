<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeeRequest;
use App\Models\Fee;
use App\Models\student;
use App\Models\student_fee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees=Fee::all();
       return view('theme.fee.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('theme.fee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            // إنشاء المصروف
            $fee = Fee::create($data);

            // جلب الطلاب اللي في نفس المرحلة/الصف/القسم
            $students = student::where('grade_id', $request->grade_id)
                ->where('classroom_id', $request->classe_id) 
                ->where('section_id', $request->section_id)
                ->get();

            foreach ($students as $student) {
             student_fee::create([
                    'student_id'       => $student->id,
                    'fee_id'           => $fee->id, 
                    'academic_year'    => $request->academic_year,
                    'amount'           => $request->amount,
                    'remaining_amount' => $request->amount,
                    'due_date'         =>  Carbon::now(),
                    'status'           => 'unpaid',
                ]);
            }

            DB::commit();
            return redirect()->route('theme.fee.index')->with('success', 'تم إضافة المصروف وربطه بالطلاب بنجاح ✅');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'فشل إضافة المصروف: ' . $e->getMessage());
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fee = Fee::findOrFail($id);
        $fee->delete();

        return redirect()->route('theme.fee.index')->with('success', 'Section deleted successfully');
    }
}
