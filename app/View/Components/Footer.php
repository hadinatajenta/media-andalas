<?php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\KategoriModel;
use App\Models\WebsiteModel;
class Footer extends Component
{
    public $categories;
    public $websiteInfo;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = KategoriModel::all();
        $this->websiteInfo = WebsiteModel::first();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
