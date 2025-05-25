<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();

        return view('management.about', compact('about'));
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
        $about = About::all()->count();
        if ($about > 0) {
               return redirect()->route('about.index')
                   ->withErrors(['about record already exist!']);
        }
        // Validate the incoming request
       $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // max 10MB
            'cv' => 'required|file|max:10240|mimes:pdf', // max 10MB
            'about' => 'required|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Generate a unique filename with original extension
            $imageFileName = time() . '-' . Str::random(10) . '.' .
                $request->file('image')->getClientOriginalExtension();

            // Store the file in public/images directory
            $request->file('image')->move(public_path('images'), $imageFileName);

            // Save image path to database or session
            $imagePath = 'images/' . $imageFileName;
        }

        // Handle document upload
        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            // Generate a unique filename
            $documentFileName = time() . '-' . Str::random(10) . '.' .
                $request->file('cv')->getClientOriginalExtension();

            // Store the file in public/files directory
            $request->file('cv')->move(public_path('files'), $documentFileName);

            // Save document path to database or session
            $documentPath = 'files/' . $documentFileName;
        }

        // Save the description and file paths to database
        // This is where you would typically save to your model
        // For example:

        $about = new About();
        $about->about = $request->about;
        $about->image = $imagePath ?? null;
        $about->cv = $documentPath ?? null;
        $about->save();

        // Redirect with success message
        return redirect()->route('about.index')
            ->with('success', 'Information submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $about = About::first();
        $imagePath = '';
        $documentPath = '';

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Generate a unique filename with original extension
            $imageFileName = time() . '-' . Str::random(10) . '.' .
                $request->file('image')->getClientOriginalExtension();

            // Store the file in public/images directory
            $request->file('image')->move(public_path('images'), $imageFileName);

            // Save image path to database or session
            $imagePath = 'images/' . $imageFileName;
        }

        // Handle document upload
        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            // Generate a unique filename
            $documentFileName = time() . '-' . Str::random(10) . '.' .
                $request->file('cv')->getClientOriginalExtension();

            // Store the file in public/files directory
            $request->file('cv')->move(public_path('files'), $documentFileName);

            // Save document path to database or session
            $documentPath = 'files/' . $documentFileName;
        }

        if ($imagePath){
            $about->image = $imagePath;
        }
        if ($documentPath){
            $about->cv = $documentPath;
        }
        $about->about=$request->about;
        $about->save();

        return redirect()->route('about.index')->with('success', 'Information updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        //
    }
}
