<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteModel extends Model
{
    use HasFactory;

    protected $table = 'website';
    protected $fillable = [
        'nama_website',
        'deskripsi_website',
        'keyword_website',
        'no_telp',
        'alamat',
        'email',
        'robot_txt', 
        'favicon',
        'updated_at',
    ];

}
