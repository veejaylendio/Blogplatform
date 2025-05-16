<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\HeaderSocialURLS;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialURLValue = HeaderSocialURLS::get();

        return view('management.headerSocialURLS', compact('socialURLValue'));
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
           'platformName' => 'required',
           'url' => 'required|url',
        ]);
        $saveSocialURL = new HeaderSocialURLS();

        $saveSocialURL->platform = $request->platformName;
        $saveSocialURL->url = $request->url;

        $saveSocialURL->save();

        return redirect()->back()->with('success', 'Successfully Add Social URL!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeaderSocialURLS $headerSocialURLS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $social = HeaderSocialURLS::find($id)->first();
        return view('management.headerEditSocialURLS', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $social = HeaderSocialURLS::find($id)->first();
        $platform = request('platformName');
        $url = request('url');

        $social->platform = $platform;
        $social->url = $url;
        $social->save();

        return redirect()->route('social.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $social = HeaderSocialURLS::find($id)->first();
        $social->delete();

        return redirect()->route('social.index');
    }
}
