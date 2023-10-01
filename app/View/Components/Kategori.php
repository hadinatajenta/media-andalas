<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\KategoriModel;

class Kategori extends Component
{
    public $categories;
    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct()
    {
        $this->categories = KategoriModel::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.kategori');
    }
}
