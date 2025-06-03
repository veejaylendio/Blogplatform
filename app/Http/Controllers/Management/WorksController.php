<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Works;
use Illuminate\Http\Request;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Works::all();

        return view('management.worksIndex', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.worksCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'works_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'works_title' => 'required',
            'works_project_type' => 'required',
            'works_description' => 'required',
        ]);

        if ($request->hasFile('works_image')) {
             $file = $request->file('works_image');

             $extension = $file->getClientOriginalExtension();
             $filename = time() . '.' . $extension;
             $file->move('images/', $filename);
        }else{
            $filename = '';
        }

        $works = new Works();
        $works->works_title = $request->works_title;
        $works->works_project_type = $request->works_project_type;
        $works->works_url = $request->works_url;
        $works->works_description = $request->works_description;
        if ($filename != '') {
            $works->works_image = 'images/' . $filename;
        }
        $works->save();

        return redirect()->route('works.index')->with('success', 'Recent Works Successfully Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Works $works)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Works $works, $id)
    {
        $works = Works::find($id);

        return view('management.worksEdit', compact('works'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $work)
    {
        $work_data = Works::find($work);
        $request->validate([
            'works_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'works_title' => 'required',
            'works_project_type' => 'required',
            'works_description' => 'required',
        ]);

        if ($request->hasFile('works_image')) {
            $file = $request->file('works_image');

            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $work_data->works_image = 'images/' . $filename;
        }

        $work_data->works_title = $request->works_title;
        $work_data->works_project_type = $request->works_project_type;
        $work_data->works_url = $request->works_url;
        $work_data->works_description = $request->works_description;

        $work_data->save();
        return redirect()->route('works.index')->with('success', 'Recent Works Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Works $works, $id)
    {
        $works = Works::find($id);
        $works->delete();
        return redirect()->back()->with('success', 'Recent Works Successfully Deleted');

    }
}
