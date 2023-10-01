<?php

namespace App\Http\Controllers;
use App\Models\BeritaModel;
use App\Models\IklanModel;
use App\Models\KategoriModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
class AdminBeritaController extends Controller
{
    public function search(Request $request)
    {
        $status = $request->input('status');
        $searchTerm = $request->input('search');

        if ($status) {
            $berita = BeritaModel::where('status', $status)
                                ->with('author')
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
        } else if ($searchTerm) {
            $berita = BeritaModel::where('judul_berita', 'LIKE', '%' . $searchTerm . '%')
                                ->with('author')
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
        } else {
            $berita = BeritaModel::with('author')
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
        }

        // If there are no results, redirect back with an error message
        if($berita->isEmpty()) {
            return redirect()->back()->with('error', 'No results found for your search');
        }

        
        $jumlahBeritaMenunggu = BeritaModel::where('status', 'waiting')->count();
        $dipublikasikan = BeritaModel::where('status', 'Published')->count();
        $totalauthor = UsersModel::where('role', 'author')->count();
        $totalkategori = KategoriModel::count();    
        $totalIklan = IklanModel::count();
    
        // Return the view with the search results
        return view('admin.dashboard')->with(compact(
            'berita',
            'jumlahBeritaMenunggu',
            'dipublikasikan',
            'totalkategori',
            'totalauthor',
            'totalIklan'
        ));
    }

    public function index(Request $request) {
        $status = $request->get('status');
        $berita = BeritaModel::where('status', $status)->paginate(10);

        return view('admin.dashboard', ['berita' => $berita]);
    }

    //Membuat berita menjadi featured
    public function makeFeatured($id)
    {
        $berita = BeritaModel::findOrFail($id);
        $berita->featured = true;
        $berita->save();

        return redirect()->route('admin.dashboard');
    }
    //Membuat berita menjadi unfeatured
    public function removeFeatured($id)
    {
        $berita = BeritaModel::findOrFail($id);
        $berita->featured = false;
        $berita->save();

        return redirect()->route('admin.dashboard');
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
            return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil dihapus'); //Kembali ke halaman sebelumnya
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Berita tidak ditemukan');// Redirect to the dashboard with an error message
        }
    }

    public function create(){
        $kategori = KategoriModel::all();
        return view('admin.management-berita.buat', compact('kategori'));
    }
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
            'status' => $request->has('saveAsDraft') ? 'draft' : 'Published',
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

        return redirect()->route('admin.dashboard');
    }

}
