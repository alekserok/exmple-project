<?php


namespace App\Http\Controllers;


use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $category = 1;

        if ($request->has('category')) $category = $request->get('category');

        $faqs = Faq::where('category_id', $category)->get();

        return view('faq', compact( 'faqs'));
    }
}
