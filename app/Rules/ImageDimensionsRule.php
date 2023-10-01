<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\IklanModel;

class ImageDimensionsRule implements Rule
{
    protected $id_iklan;

    public function __construct($id_iklan)
    {
        $this->id_iklan = $id_iklan;
    }

    public function passes($attribute, $value)
    {
        // Ambil data iklan berdasarkan ID
        $iklan = IklanModel::find($this->id_iklan);

        // Dapatkan lebar dan tinggi gambar
        list($width, $height) = getimagesize($value);

        // Periksa apakah lebar dan tinggi gambar tidak melebihi yang ditentukan di database
        return $width <= $iklan->lebar_gambar && $height <= $iklan->tinggi_gambar;
    }

    public function message()
    {
        return 'Ukuran gambar tidak boleh melebihi jenis iklan yang dipilih.';
    }
}
