<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\PengiklanModel;


class Iklan800x500 extends Component
{
    public $iklan;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->iklan = PengiklanModel::whereHas('iklan', function($query){
            $query->where('id_iklan', '2');
        })->where('status', 'berjalan')->first();
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.iklan-800x500');
    }

}