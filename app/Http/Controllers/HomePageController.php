<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeritaModel;
use App\Models\PengiklanModel;
use App\Models\WebsiteModel;
use App\Models\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomePageController extends Controller
{
    public function index(){
        //Mendapatkan data website
        $website = WebsiteModel::first();

        //Menampilkan  Featured News pada halaman welcome
        $berita = BeritaModel::where('featured', '1')
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();
        
        //menampilkan berita terbaru
        $latestnews = BeritaModel::where('status', 'Published')
        ->orderBy('created_at', 'desc')
        ->limit(13)
        ->get();
        
        //Menampilkan iklan vertikal yang berstatus berjalan
        $iklan = PengiklanModel::whereHas('iklan', function($query) {
            $query->where('id_iklan', '1');
        })->where('status', 'berjalan')->first();

        $mostViewedBerita = View::select('post_id', DB::raw('count(*) as total'))
        ->groupBy('post_id')
        ->orderBy('total', 'desc')
        ->limit(4)
        ->get()
        ->map(function($view) {
            $view->berita = BeritaModel::find($view->post_id)->load('kategori');
            return $view;
        });
        
       

        // Pass the trending news to the view
        return view('welcome', compact('berita','latestnews','iklan','website','mostViewedBerita'));
    }

 
}
