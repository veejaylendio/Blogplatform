<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\expertise;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expertise = Expertise::get();

        return view('management.expertiseIndex', compact('expertise'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'expertise' => 'required',
        ]);

        $expertise = new Expertise();
        $expertise ->expertise = $request->expertise;
        $expertise ->save();
        return redirect()->back()->with('success', 'Expertise added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(expertise $expertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $expertise = Expertise::find($id);

        return view('management.expertiseEdit', compact('expertise') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, expertise $expertise, $id)
    {
        $validation = $request->validate([
            'expertise' => 'required',
        ]);
        $expertise = Expertise::find($id);
        $updatedExpertise = request('expertise');

        $expertise ->expertise = $updatedExpertise;
        $expertise ->save();
        return redirect()->route('expertise.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $expertise = Expertise::find($id);
        $expertise ->delete();

        return redirect()->route('expertise.index');
    }

}
