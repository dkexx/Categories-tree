<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $recursive = $this->formatHierarchyRecursive($categories);

        return view("categories", ['categories' => $recursive]);
    }

    private function formatHierarchyRecursive($categories, $parent_id = null)
    {
        $branch = array();
        foreach ($categories as $category) {
            if ($category->parent == $parent_id) {
                $category_child = $this->formatHierarchyRecursive($categories, $category->id);
                if ($category_child) {
                    $category->child = $category_child;
                }
                $branch[] = $category;
            }
        }
        return collect($branch);
    }

    public function store(Request $request)
    {

        $name = $request->input('name');
        $parent = $request->input('parent');

        $request->validate([
            'name' => 'required|string|max:255',
            'parent' => 'nullable|integer',
        ]);

        $category = new Category;
        $category->name = $name;
        $category->parent = $parent;
        $category->save();

        $request->session()->flash('success', 'Task was successful!');

        return redirect('/');
    }
}
