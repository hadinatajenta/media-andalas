<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteModel;

class WebsiteController extends Controller
{
    public function index()
    {   
        $website = WebsiteModel::first();
        return view('/admin/settings/pengaturan-website', compact('website'));
    }

   public function update(Request $request)
    {
        $website = WebsiteModel::first();

        if ($website) {
            if ($request->has('nama_website')) {
                $website->nama_website = $request->nama_website;
            }
            if ($request->has('deskripsi_website')) {
                $website->deskripsi_website = $request->deskripsi_website;
            }
            if ($request->has('keyword_website')) {
                $website->keyword_website = $request->keyword_website;
            }
            if ($request->has('no_telp')) {
                $website->no_telp = $request->no_telp;
            }
            if ($request->has('alamat')) {
                $website->alamat = $request->alamat;
            }
            if ($request->has('email')) {
                $website->email = $request->email;
            }
            if ($request->has('robot_txt')) {
                $website->robot_txt = $request->robot_txt;
            }
            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                $filename = 'favicon.' . $favicon->getClientOriginalExtension();
                $favicon->move(public_path('images'), $filename);
                $website->favicon = 'images/' . $filename;
            }
            $website->save();
        } else {
            $faviconFilename = null;
            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                $filename = 'favicon.' . $favicon->getClientOriginalExtension();
                $favicon->move(public_path('images'), $filename);
                $faviconFilename = 'images/' . $filename;
            }

            $website = WebsiteModel::create([
                'nama_website' => $request->has('nama_website') ? $request->nama_website : null,
                'deskripsi_website' => $request->has('deskripsi_website') ? $request->deskripsi_website : null,
                'keyword_website' => $request->has('keyword_website') ? $request->keyword_website : null,
                'no_telp' => $request->has('no_telp') ? $request->no_telp : null,
                'alamat' => $request->has('alamat') ? $request->alamat : null,
                'email' => $request->has('email') ? $request->email : null,
                'robot_txt' => $request->has('robot_txt') ? $request->robot_txt : null,
                'favicon' => $faviconFilename,
            ]);
        }

        return redirect('admin/settings/pengaturan-website')->with('success', 'Pengaturan website berhasil diperbarui!');
    }

    public function showKontakPage(){
        $website = WebsiteModel::first();
        return view('kontak', compact('website'));
    }

    public function showRedaksiPage(){
        $website = WebsiteModel::first();
        return view('redaksi', compact('website'));
    }
    public function showDisclaimer(){
        $website = WebsiteModel::first();
        return view('disclaimer', compact('website'));
    }
}
