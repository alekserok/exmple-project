<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Promo;
use Illuminate\Http\Request;

class PromosController extends Controller
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
            $promos = Promo::where('title', 'LIKE', "%$keyword%")
                ->orWhere('link_title', 'LIKE', "%$keyword%")
                ->orWhere('location_page', 'LIKE', "%$keyword%")
                ->orderBy('id', 'desc')->paginate($perPage);
        } else {
            $promos = Promo::orderBy('id', 'desc')->paginate($perPage);
        }

        return view('admin.promos.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.promos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\PromosRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Requests\PromosRequest $request)
    {
        $requestData = $request->all();

        if ($request->hasFile('media'))
            $requestData['media'] = $request->file('media')->store('promos', 'public');

        Promo::create($requestData);

        return redirect('admin/promos')->with('flash_message', 'Promo added!');
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
        $promo = Promo::findOrFail($id);

        return view('admin.promos.show', compact('promo'));
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
        $promo = Promo::findOrFail($id);

        return view('admin.promos.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\PromosRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Requests\PromosRequest $request, $id)
    {
        $requestData = $request->all();
        
        $promo = Promo::findOrFail($id);

        if ($request->hasFile('media'))
            $requestData['media'] = $request->file('media')->store('promos', 'public');

        $promo->update($requestData);

        return redirect('admin/promos')->with('flash_message', 'Promo updated!');
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
        Promo::destroy($id);

        return redirect('admin/promos')->with('flash_message', 'Promo deleted!');
    }
}
