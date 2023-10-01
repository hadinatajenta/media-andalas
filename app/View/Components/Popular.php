<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\View;
use Illuminate\Support\Facades\DB;
use App\Models\BeritaModel;

class Popular extends Component
{
    public $mostViewedBerita;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mostViewedBerita = View::select('post_id', DB::raw('count(*) as total'))
            ->groupBy('post_id')
            ->orderBy('total', 'desc')
            ->limit(4)
            ->get()
            ->map(function($view) {
                $view->berita = BeritaModel::find($view->post_id)->load('kategori');
                return $view;
            });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.popular');
    }
}
