<?php

namespace App\Http\Controllers;
use App\Models\KategoriModel;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    
    public function index()
    {
        $kategori = KategoriModel::withCount('berita')->get();
        return view('admin.kategori', compact('kategori'));
    }

    public function store(){
        $kategori = new KategoriModel();
        $kategori->nama_kategori = request('nama_kategori');
        $kategori->save();

        return redirect('/admin/kategori');
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect('/admin/kategori');
    }
    public function destroy($id)
    {
        $kategori = KategoriModel::find($id);
        if (!$kategori) {
            return redirect()->back();
        }

        $kategori->delete();
        return redirect('/admin/kategori');
    }
    
}
