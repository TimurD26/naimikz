<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'category_name' => ['required', 'string']
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        return $category;
    }

    public function getAll()
    {
        $categories = Category::get();

        return $categories;
    }

    public function update($id, Request $request )
    {
        $category = Category::find($id);
        $category->category_name = $request->category_name;

        $category->save();

        return $category;
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        
        $category->delete();

        return $category;
    }
}
