<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Performer;
use Illuminate\Http\Request;

class PerformersController extends Controller
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
            $performers = Performer::where('letter', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $performers = Performer::latest()->paginate($perPage);
        }

        return view('admin.performers.index', compact('performers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.performers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Requests\PerformersRequest $request)
    {
        $this->validate($request, ['letter' => 'unique:performers,letter']);

        $requestData = $request->except(['services', 'categories']);

        $performer = Performer::create($requestData);
        $performer->services()->attach($request->get('services'));
        $performer->categories()->attach($request->get('categories'));
        $performer->colors()->attach($request->get('colors'));

        $this->storeImages($request, $performer);

        return redirect('admin/performers')->with('flash_message', 'Performer added!');
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
        $performer = Performer::findOrFail($id);

        return view('admin.performers.show', compact('performer'));
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
        $performer = Performer::findOrFail($id);

        return view('admin.performers.edit', compact('performer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Requests\PerformersRequest $request, $id)
    {
        $this->validate($request, ['letter' => 'unique:performers,letter,' . $id]);

        $requestData = $request->except(['services', 'categories']);

        $performer = Performer::findOrFail($id);
        $performer->update($requestData);
        $performer->services()->sync($request->get('services'));
        $performer->categories()->sync($request->get('categories'));
        $performer->colors()->sync($request->get('colors'));

        $this->storeImages($request, $performer);

        return redirect('admin/performers')->with('flash_message', 'Performer updated!');
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
        Performer::destroy($id);

        return redirect('admin/performers')->with('flash_message', 'Performer deleted!');
    }

    private function storeImages(Request $request, $performer)
    {
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $performer->images()->create([
                    'title' => $performer->name,
                    'alt' => $performer->name,
                    'src' => $image->store('images', 'public')
                ]);
            }
        }
    }
}
