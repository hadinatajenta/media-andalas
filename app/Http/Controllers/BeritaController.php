<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BeritaModel;
use App\Models\KategoriModel;
use App\Models\View;
    /**
     * 
     *  Halaman ini digunakan untuk mengatur berita
     *  yang ditulis oleh user dengan role author.
     * 
     * **/
class BeritaController extends Controller
{
    //Menampilkan semua berita yang ditulis oleh user dengan role author pada halaman author.dashboard
   public function index()
    {
        $berita = BeritaModel::paginate(10);


    return view('author.dashboard', compact('berita'));
}
    //Menampilkan halaman tambah berita dan memanggil kategori berita dari database
    public function create()
    {
        $kategori = KategoriModel::all();
        return view('author.tambah-berita', compact('kategori'));
    }

    //Menyimpan data berita baru ke database
    public function store(Request $request)
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


        // Slug creation and check
        $slug = $request->slug ? $request->slug : Str::slug($request->judul_berita, '-');
        if ($request->slug == 'auto') {
            $slug = Str::slug($request->judul_berita, '-');
        } else {
            $slug = $request->slug;
        }
        
        $count = BeritaModel::where('slug', 'like', "%$slug%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        // Creating new instance of BeritaModel
        $berita = new BeritaModel([
            'judul_berita' => $request->judul_berita,
            'deskripsi_berita' => $request->deskripsi_berita,
            'isi_berita' => $request->isi_berita,
            'kategori_berita' => $request->kategori_berita,
            'slug' => $slug,
            'keyword_berita' => $request->keyword_berita,
            'author_id' => auth()->user()->id,
            'status' => $request->has('saveAsDraft') ? 'draft' : 'waiting',
            'youtube_link' => $request->youtube_link,
        ]);

        // If there's a uploaded image
        if ($request->hasFile('gambar_berita')) {
            $file = $request->file('gambar_berita');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/berita', $filename);
            $berita->gambar_berita = $filename; // Setting gambar_berita
        }

        // Save the berita to the database
        $berita->save();

        // Update the kategori's total_berita
        $kategori = KategoriModel::find($request->kategori_berita);
        if ($kategori) {
            $kategori->total_berita += 1;
            $kategori->save();
        }

        return redirect()->route('author.dashboard');
    }

    //edit
    public function edit($id)
    {
        $berita = BeritaModel::find($id);
        $kategori = KategoriModel::all();
        return view('author.management-berita.edit', compact('berita', 'kategori'));
    }
  
    public function update(Request $request, $id){ //Mengupdate berita
        $kategori = KategoriModel::all();
        $berita = BeritaModel::find($id);
        $request->validate([
            'judul_berita' => 'required',
            'deskripsi_berita' => 'required',
            'isi_berita' => 'required',
            'kategori_berita' => 'required',
            'gambar_berita' => 'image|nullable|max:1999',
            'keyword_berita' => 'required',
        ]);
        
        $berita->judul_berita = $request->judul_berita;
        $berita->deskripsi_berita = $request->deskripsi_berita;
        $berita->isi_berita = $request->isi_berita;
        $berita->kategori_berita = $request->kategori_berita;
        $berita->keyword_berita = $request->keyword_berita;
        if ($request->hasFile('gambar_berita')) {
            $file = $request->file('gambar_berita');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/berita', $filename);
            $berita->gambar_berita = $filename; // Updating gambar_berita
        }
        $berita->save();
        return redirect()->route('author.dashboard');

    }

    public function destroy($id) //Menghapus berita yang dipilih berdasarkan id
    {
        $berita = BeritaModel::find($id);
        if ($berita) {
            $berita->delete(); //jika berita ditemukan-> hapus berita.
            $kategori = KategoriModel::find($berita->kategori_berita);
            if ($kategori) { //Mengurangi jumlah berita pada kategori
                $kategori->total_berita -= 1;
                $kategori->save();
            }
            return redirect()->route('author.dashboard')->with('success', 'Berita berhasil dihapus'); //Kembali ke halaman sebelumnya
        } else {
            return redirect()->route('author.dashboard')->with('error', 'Berita tidak ditemukan');// Redirect to the dashboard with an error message
        }
    }
}
