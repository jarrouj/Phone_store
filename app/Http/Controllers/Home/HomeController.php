<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Landing;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $landings = Landing::all();
        $blogs     = Blog::all();
        $testimonials     = Testimonial::all();

        return view('Home.home' , compact('landings' , 'blogs' , 'testimonials'));
    }
}
