<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeritaModel;
use App\Models\KategoriModel;
use Illuminate\Support\Str;

class StatusController extends Controller
{

    
    public function show($id)
    {
        $berita = BeritaModel::with('kategori','author')->findOrFail($id);
        $kategori = KategoriModel::all();

        return view('/admin/management-berita/detail-berita-menunggu-persetujuan', compact('berita', 'kategori'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'judul_berita' => 'required',
        'deskripsi_berita' => 'required',
        'isi_berita' => 'required',
        'kategori_berita' => 'required',
        'gambar_berita' => 'image|nullable|max:1999',
        'keyword_berita' => 'required',
        'youtube_link' => 'nullable|url',
    ]);

    // Fetch existing berita
    $berita = BeritaModel::findOrFail($id);

    // Update the berita details
    $berita->judul_berita = $request->judul_berita;
    $berita->deskripsi_berita = $request->deskripsi_berita;
    $berita->isi_berita = $request->isi_berita;
    $berita->kategori_berita = $request->kategori_berita;
    $berita->keyword_berita = $request->keyword_berita;
    $berita->status = $request->has('saveAsDraft') ? 'draft' : 'Published';
    $berita->youtube_link = $request->youtube_link;

    // If there's a uploaded image
    if ($request->hasFile('gambar_berita')) {
        $file = $request->file('gambar_berita');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $filename);
        $berita->gambar_berita = $filename; // Setting gambar_berita
    }

    // Save the updated berita
    $berita->save();

    // Update the kategori's total_berita
    $oldKategoriId = $berita->getOriginal('kategori_berita');
    if ($oldKategoriId !== $request->kategori_berita) {
        $oldKategori = KategoriModel::find($oldKategoriId);
        if ($oldKategori) {
            $oldKategori->total_berita -= 1;
            $oldKategori->save();
        }

        $newKategori = KategoriModel::find($request->kategori_berita);
        if ($newKategori) {
            $newKategori->total_berita += 1;
            $newKategori->save();
        }
    }

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil diupdate!');
}

}
