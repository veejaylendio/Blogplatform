<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $education = Education::get();

        return view('management.educationIndex', compact('education'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.educationCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'institution_name' => 'required',
            'degree_name' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);

        $education = new Education();
        $education->institution_name=$request->institution_name;
        $education->degree_name=$request->degree_name;
        $education->date=$request->date;
        $education->description=$request->description;
        $education->save();
        return redirect()->route('education.index')->with('success', 'Education Successfully Saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $education = Education::find($id);

        return view('management.educationEdit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'institution_name' => 'required',
            'degree_name' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);

        $education = Education::find($id);
        $education->institution_name=$request->institution_name;
        $education->degree_name=$request->degree_name;
        $education->date=$request->date;
        $education->description=$request->description;
        $education->save();
        return redirect()->route('education.index')->with('success', 'Changes Saved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $education= Education::find($id);
        $education->delete();

        return back()->with('success', 'Deleted Successfully!');
    }
}
