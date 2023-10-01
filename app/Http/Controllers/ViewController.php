<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\View;
use App\Models\BeritaModel;
class ViewController extends Controller
{
    public function show(BeritaModel $berita)
    {
        $view = new View;
        $view->id_berita = $berita->id;
        $view->ip_address = request()->ip();
        $view->save();
    }

}
