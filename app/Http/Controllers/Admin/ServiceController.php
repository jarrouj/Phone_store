<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show_service()
    {
        $service = Service::latest()->paginate(10);

        return view('admin.service')
    }
}
