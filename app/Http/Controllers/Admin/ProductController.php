<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function show_product()
    {
        $product    = Product::latest()->paginate(10);
        $categories = Category::all();

        return view('Admin.product.show_product' , compact('product' , 'categories'));
    }

    public function add_product(Request $request)
    {

        $product = new Product();

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        $img = $request->img;


        if($img)
        {
            $imgname = Str::random(20) . '.' . $img->getClientOriginalExtension();

            //Save the original image
            $request->img->move('product', $imgname);

            //change the image quality using Intervention Image
            $img = Image::make(public_path('product/' . $imgname));

            $img->encode($img->extension, 10)->save(public_path('product/' . $imgname));

            $product->img = $imgname;
        }

        $product->save();

        return redirect()->back()->with('message' , 'Product Added Successfully');
    }

    public function update_product(Request $request , $id)
    {
        $product = Product::find($id);

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        $img = $request->img;


        if($img)
        {
            $imgname = Str::random(20) . '.' . $img->getClientOriginalExtension();

            //Save the original image
            $request->img->move('product', $imgname);

            //change the image quality using Intervention Image
            $img = Image::make(public_path('product/' . $imgname));

            $img->encode($img->extension, 10)->save(public_path('product/' . $imgname));

            $product->img = $imgname;
        }

        $product->save();

        return redirect()->back()->with('message' , 'Product Updated Successfully');
    }

    public function delete_product($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->back()->with('message' , 'Product Deleted Successfully');
    }

    public function view_product($id)
    {
        $product  = Product::find($id);
        $category = Category::all();

        return view('Admin.product.view_product' , compact('product' , 'category'));

    }

    public function search_product(Request $request)
    {
        $query = $request->input('query');

        // Fetch products matching the query
        $products = Product::where('name', 'LIKE', "%$query%")->get();

        // Fetch all categories
        $categories = Category::all();

        // Map products to include category names
        $response = $products->map(function($product) use ($categories) {
            $category = $categories->firstWhere('id', $product->category_id);
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'img' => $product->img,
                'category_id' => $product->category_id,
                'category_name' => $category ? $category->name : 'Uncategorized',
            ];
        });

        return response()->json([
            'products' => $response,
            'categories' => $categories,
        ]);
    }



}
