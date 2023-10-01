<?php

namespace App\Http\Controllers;
use App\Models\BeritaModel;
use Illuminate\Http\Request;
use App\Models\View;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Illuminate\Support\Facades\Http;
use App\Models\WebsiteModel;

class ReadingController extends Controller
{
    //Menampilkan isi berita yang di klik pada halaman single
   public function show($slug){
    $website = WebsiteModel::first();

    //Mengambil data dari tabel berita berdasarkan slug
    $berita = BeritaModel::where('slug', $slug)->first();
    
    // Membuat View baru dan mengisi data
    $view = new View;
    $view->post_id = $berita->id_berita;  // Diperbaiki disini
    $view->ip_address = request()->ip();

    // Mengambil data lokasi dari IP-API
    $response = Http::get("http://ip-api.com/json/{$view->ip_address}");
    
    // Jika request berhasil, simpan lokasi
    if ($response->successful()) {
        $location = $response->json();

        if (isset($location['regionName'], $location['country'])) {
            $view->location = $location['regionName'] . ', ' . $location['country'];
        } else {
            $view->location = 'Unknown location';
        }
    }

    $view->save();

    // SEO stuff
    SEO::setTitle($berita->judul_berita);
    SEO::setDescription($berita->deskripsi_berita);
    SEO::metatags()->setKeywords($berita->keyword_berita);
    SEO::opengraph()->addProperty('article:published_time', $berita->created_at->toW3CString());
    SEO::opengraph()->addProperty('article:modified_time', $berita->updated_at->toW3CString());
    
    return view('single',compact('berita','website'));
}

}
