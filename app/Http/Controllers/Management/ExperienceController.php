<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::all();
        return view('management.experienceIndex', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.experienceCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'job_title'=> 'required',
            'start_month'=> 'required',
            'start_year'=> 'required',
            'description' => 'required',
        ]);
        $experience = new Experience();
        $experience->company_name = $request->input('company_name');
        $experience->job_title= $request->input('job_title');
        $experience->start_date = $request->start_year . '-' . str_pad($request->start_month, 2, '0', STR_PAD_LEFT) . '-01';
        if ($request->has('currently_working')) {
            $experience->end_date = null;
            $experience->currently_working = true;
        } else {
            $request->validate([
                'end_month'=> 'required',
                'end_year'=> 'required'
            ]);
            $experience->end_date = $request->end_year . '-' . str_pad($request->end_month, 2, '0', STR_PAD_LEFT) . '-01';
            $experience->currently_working = false;
        }
        $experience->description= $request->input('description');
        $experience->save();
        return redirect()->route('experience.index', compact('experience'))->with('success', 'Experience saved successfully!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        return view('management.experienceEdit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $request->validate([
            'company_name' => 'required',
            'job_title'=> 'required',
            'start_month'=> 'required',
            'start_year'=> 'required',
            'description' => 'required',
        ]);

        $experience->company_name = $request->input('company_name');
        $experience->job_title= $request->input('job_title');
        $experience->start_date = $request->start_year . '-' . str_pad($request->start_month, 2, '0', STR_PAD_LEFT) . '-01';
        if ($request->has('currently_working')) {
            $experience->end_date = null;
            $experience->currently_working = true;
        } else {
            $request->validate([
                'end_month'=> 'required',
                'end_year'=> 'required'
            ]);
            $experience->end_date = $request->end_year . '-' . str_pad($request->end_month, 2, '0', STR_PAD_LEFT) . '-01';
            $experience->currently_working = false;
        }
        $experience->description= $request->input('description');
        $experience->save();

        return redirect()->route('experience.index', compact('experience'))->with('success', 'Experience saved successfully!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('experience.index')->with('success', 'Experience deleted successfully!.');
    }
}
