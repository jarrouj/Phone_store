<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function show_testimonial()
    {
        $testimonial = Testimonial::latest()->paginate(10);
        return view('admin.testimonial.show_testimonial' , compact('testimonial'));
    }

    public function add_testimonial(Request $request)
    {
        $testimonial = new Testimonial();

        $testimonial->title = $request->title;
        $testimonial->text  = $request->text;

        $testimonial->save();

        return redirect()->back()->with('message' , 'testimonial Added Successfully');
    }

    public function update_testimonial(Request $request , $id)
    {
        $testimonial = Testimonial::find($id);

        $testimonial->title = $request->title;
        $testimonial->text  = $request->text;

        $testimonial->save();

        return redirect()->back()->with('message' , 'testimonial Updated Successfully');
    }

    public function delete_testimonial($id)
    {
        $testimonial = Testimonial::find($id);

        $testimonial->delete();

        return redirect()->back()->with('message' , 'testimonial Deleted Successfully');

    }
}
