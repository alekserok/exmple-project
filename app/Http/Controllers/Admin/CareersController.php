<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Career;
use Illuminate\Http\Request;

class CareersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $careers = Career::where('name', 'LIKE', "%$keyword%")
                ->orWhere('age', 'LIKE', "%$keyword%")
                ->orWhere('nationality', 'LIKE', "%$keyword%")
                ->orWhere('language', 'LIKE', "%$keyword%")
                ->orWhere('contacts', 'LIKE', "%$keyword%")
                ->orWhere('socials', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $careers = Career::latest()->paginate($perPage);
        }

        return view('admin.careers.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.careers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
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
        $requestData = $request->all();

        Career::create($requestData);

        return redirect('admin/careers')->with('flash_message', 'Career added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $career = Career::findOrFail($id);

        return view('admin.careers.show', compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $career = Career::findOrFail($id);

        return view('admin.careers.edit', compact('career'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
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
        $requestData = $request->all();

        $career = Career::findOrFail($id);
        $career->update($requestData);

        return redirect('admin/careers')->with('flash_message', 'Career updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Career::destroy($id);

        return redirect('admin/careers')->with('flash_message', 'Career deleted!');
    }
}
