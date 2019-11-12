<?php

namespace App\Http\Controllers;

use App\Category;
use App\Performer;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PerformerController extends Controller
{
    public function index(Request $request)
    {
        $category = null;

        if ($request->has('category_id')) {
            $category = Category::findOrFail($request->get('category_id'));
            $performers = Performer::whereHas('categories', function ($query) use ($category) {
                $query->where('id', $category->id);
            })->get();
        } else {
            $performers = Performer::all();
        }

        return view('performers.index', compact('performers', 'category'));
    }

    public function show(Request $request, $id)
    {
        $performer = Performer::findOrFail($id);

        if ($request->ajax()) return $performer;

        return view('performers.show', compact('performer'));
    }

    public function services($performer_id)
    {
        $services = Service::performerServices($performer_id)->orderBy('name')->get();
        return View::make('orders.partials.services', compact('services'));
    }

    public function avatar($performer_id)
    {
        $performer = Performer::findOrFail($performer_id);
        return $performer->avatar;
    }
}
