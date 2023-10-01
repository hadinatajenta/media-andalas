<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaModel extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita'; 
    
    protected $fillable = [
        'judul_berita',
        'deskripsi_berita',
        'isi_berita',
        'gambar_berita',
        'alt',
        'kategori_berita',
        'keyword_berita',
        'slug',
        'author_id',
        'status',
        'featured',
        'youtube_link',
    ];
    public function kategori()
    {
        return $this->belongsTo('App\Models\KategoriModel', 'kategori_berita', 'id_kategori');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function getViewCountAttribute()
    {
        return $this->views->count();
    }
    public function views()
    {
        return $this->hasMany(View::class, 'post_id');
    }


}
