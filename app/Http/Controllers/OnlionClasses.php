<?php

namespace App\Http\Controllers;

use App\Services\ZoomService;
use MacsiDigital\Zoom\Facades\Zoom;

use App\Models\Grade;
use App\Models\OnlionClasses as ModelsOnlionClasses;
use Illuminate\Http\Request;

class OnlionClasses extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $online_classes= ModelsOnlionClasses::with('grade', 'classroom','section')->get();
       
        return view('theme.onlion_class.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('theme.onlion_class.add_onlion_class');
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(Request $request, ZoomService $zoomService)
    {
        $request->validate([
            'topic'      => 'required|string|max:255',
            'start_time' => 'required|date|after:now',
            'duration'   => 'required|integer|min:15|max:300',
        ]);

        $meeting = $zoomService->createMeeting(
            $request->topic,
            $request->start_time,
            $request->duration
        );
        

        // ✅ Save in DB
        ModelsOnlionClasses::create([
            'grade_id'   => $request->grade_id,
            'classe_id'  => $request->classe_id,
            'section_id' => $request->section_id,
            'topic'      => $request->topic,
            'start_time' => $request->start_time,
            'duration'   => $request->duration,
            'meeting_id' => $meeting['id'],
            'join_url'   => $meeting['join_url'],
            'start_url'  => $meeting['start_url'],
            'password'   => $meeting['password'],
            'host_id'    => $meeting['host_id'],
        ]);

        return to_route('theme.online_classes.index')->with('success', 'تم إنشاء الاجتماع بنجاح');
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
        //
    }
}
