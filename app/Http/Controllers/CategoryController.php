<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController
{
    public function index(Request $request)
    {
        $parent = null;
        if ($request->has('parent_id')) $parent = $request->get('parent_id');

        if (!$parent) {
            $categories = Category::parentCategories()->get();
            return view('categories.parents', compact('categories'));
        }

        $parent = Category::findOrFail($parent);

        return view('categories.children', ['categories' => $parent->children]);
    }
}
