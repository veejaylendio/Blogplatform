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

        return view('management.worksIndex');
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
        //
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
    public function edit(Works $works)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Works $works)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Works $works)
    {
        //
    }
}
