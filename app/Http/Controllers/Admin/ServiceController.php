<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;


use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    public function show_service()
    {
        $service = Service::latest()->paginate(10);

        return view('Admin.service.show_service' , compact('service'));
    }

    public function add_service(Request $request)
    {
        $service = new Service();

        $service->title = $request->title;
        $service->description = $request->description;

        $icon = $request->icon;


        if($icon)
        {
            $iconname = Str::random(20) . '.' . $icon->getClientOriginalExtension();

            //Save the original image
            $request->icon->move('service', $iconname);

            //change the image quality using Intervention Image
            $icon = Image::make(public_path('service/' . $iconname));

            $icon->encode($icon->extension, 10)->save(public_path('service/' . $iconname));

            $service->icon = $iconname;
        }

        $service->save();

        return redirect()->back()->with('message' , 'Service Added Successfully');
    }

    public function update_service(Request $request , $id)
    {
        $service = Service::find($id);

        $service->title = $request->title;
        $service->description = $request->description;

        $icon = $request->icon;


        if($icon)
        {
            $iconname = Str::random(20) . '.' . $icon->getClientOriginalExtension();

            //Save the original image
            $request->icon->move('service', $iconname);

            //change the image quality using Intervention Image
            $icon = Image::make(public_path('service/' . $iconname));

            $icon->encode($icon->extension, 10)->save(public_path('service/' . $iconname));

            $service->icon = $iconname;
        }

        $service->save();

        return redirect()->back()->with('message' , 'Service Updated Successfully');
    }

    public function delete_service($id)
    {
        $service = Service::find($id);

        $service->delete();

        return redirect()->back()->with('message' , 'Service Deleted Successfully');
    }
}
