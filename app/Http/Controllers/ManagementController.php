<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeaderText;
use App\Models\HeaderSocialURLS;

class ManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function headerText()
    {
        $headerTextValue = HeaderText::first();

        return view('management.headerText', compact('headerTextValue'));
    }

    public function updateHeaderText(Request $request)
    {
        $checker = HeaderText::first();

        if($checker != null)
        {
            $getheader = HeaderText::where('id', $request->id)->first();
            $getheader->text = $request->text2;
            $getheader->update();
        }else{
            $addNewHeader = new HeaderText();
            $addNewHeader->text = $request->text2;
            $addNewHeader->save();
        }
        return back()->with('success');
    }
}
