<?php

namespace App\Http\Controllers;

use App\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        return view('career');
    }

    public function store(Request $request, $type)
    {
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'age' => 'required',
            'visa_status' => 'required',
            'nationality' => 'required',
            'language' => 'required',
            'contacts' => 'required',
            'socials' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('attachment'))
            $data['attachment'] = $request->file('attachment')->store('/careers', 'public');

        Career::create($data);

        return redirect()->back()->with('flash_message', __('Your data accepted!'));
    }
}
