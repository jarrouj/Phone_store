<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show_category()
    {
        $category = Category::latest()->paginate(10);

        return view('Admin.category.show_category', compact('category'));
    }

    public function add_category(Request $request)
    {
        $category = new Category();

        $category->name = $request->name;

        $category->save();

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function update_category(Request $request, $id)
    {
        $category = Category::find($id);

        $category->name = $request->name;

        $category->save();

        return redirect()->back()->with('message', 'Category Updated Successfully');
    }

    public function delete_category($id)
    {
        $category = Category::find($id);


        $deleteProducts = request('deleteProducts');

        if ($deleteProducts === 'yes') {
            // Delete all related products
            $category->products()->delete();
            $message = 'Category and all related products deleted successfully';
        } else {
            $message = 'Category deleted successfully without deleting related products';
        }

        $category->delete();

        return redirect()->back()->with('message', $message);
    }
}
