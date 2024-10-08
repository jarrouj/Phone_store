<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show_users()
    {
        $user = User::latest()->paginate(10);

        return view('admin.user.show_user', compact('user'));
    }

    public function update_user($id)
    {
        $user = User::find($id);

        return view('admin.user.update_user', compact('user'));
    }

    public function update_user_confirmation($id , Request $request)
    {
        $user = User::find($id);


        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->usertype = $request->usertype;

        $user->save();

        return redirect('/admin/show_user')->with('message', 'User Updated');
    }

    public function delete_user($id)
    {
        $user = user::find($id);

        $user->delete();

        return redirect()->back()->with('message', 'User Deleted');
    }

    public function search_user(Request $request)
    {
        $query = $request->get('query');

        $user = User::where('name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->paginate(10);

        return view('admin.user.show_user', compact('user'));
    }

}
