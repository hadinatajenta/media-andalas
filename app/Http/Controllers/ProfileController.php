<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        // Get the currently authenticated user's ID
        $user = Auth::user();

        // Check user's role to decide which view to use
        if ($user->hasRole('admin')) {
            return view('admin.pengaturan.profile', compact('user'));
        } elseif ($user->hasRole('author')) {
            return view('author.pengaturan.profile', compact('user'));
        }

        // If user has no role or a role that we don't recognize, return error
        return abort(403, 'User role not recognized.');
    }

    public function update(Request $request)
    {
        // Validate the request...
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'last_name',
            'no_telp',
            'bio',
            'kode_pos',
            'nomor_pegawai',
            'kota',
            'alamat',
            'link_fb',
            'link_twitter',
            'link_youtube',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Get the currently authenticated user's ID
        $user = Auth::user();
        if ($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil');
            $filename = time() . '.' . $foto_profil->getClientOriginalExtension();
            $path = $foto_profil->storeAs('profile_pictures', $filename, 'public'); 
            $user->foto_profil = $path;
        }

        // Update the user's profile
        $user->name = $request->name;
        $user->email = $request->email;
        $user->last_name = $request->last_name;
        $user->no_telp = $request->no_telp;
        $user->bio = $request->bio;
        $user->kode_pos = $request->kode_pos;
        $user->nomor_pegawai = $request->nomor_pegawai;
        $user->kota = $request->kota;
        $user->alamat = $request->alamat;
        $user->link_fb = $request->link_fb;
        $user->link_twitter = $request->link_twitter;
        $user->link_youtube = $request->link_youtube;
        

        // Check if password is set
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Redirect the user back to their profile with a success message
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
        } elseif ($user->hasRole('author')) {
            return redirect()->route('author.profile.edit')->with('success', 'Profile updated successfully.');
        }

        // If user has no role or a role that we don't recognize, return error
        return abort(403, 'User role not recognized.');
    }
   

}
