<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoriesController extends Controller
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
            $faqcategories = FaqCategory::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $faqcategories = FaqCategory::orderBy('name')->paginate($perPage);
        }

        return view('admin.faq-categories.index', compact('faqcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.faq-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Requests\FaqCategoriesRequest $request)
    {
        $requestData = $request->all();

        FaqCategory::create($requestData);

        return redirect('admin/faq-categories')->with('flash_message', 'FaqCategory added!');
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
        $faqcategory = FaqCategory::findOrFail($id);

        return view('admin.faq-categories.show', compact('faqcategory'));
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
        $faqcategory = FaqCategory::findOrFail($id);

        return view('admin.faq-categories.edit', compact('faqcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Requests\FaqCategoriesRequest $request, $id)
    {
        $requestData = $request->all();

        $faqcategory = FaqCategory::findOrFail($id);
        $faqcategory->update($requestData);

        return redirect('admin/faq-categories')->with('flash_message', 'FaqCategory updated!');
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
        FaqCategory::destroy($id);

        return redirect('admin/faq-categories')->with('flash_message', 'FaqCategory deleted!');
    }
}
