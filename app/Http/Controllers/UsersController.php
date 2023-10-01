<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAuthorNotification;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.management-author.author', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 
        $user->role = 'author';
        $user->save();
        Mail::to($user->email)->send(new NewAuthorNotification($user));
        return redirect()->back()->with('success', 'Author berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.management-author.edit', compact('user'));
    }

   
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'email' =>'required',
            'role' ,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Author berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $user = UsersModel::find($id);
        $user->delete($id);

        return redirect()->back()->with('success', 'Author berhasil dihapus!');
    }


}
