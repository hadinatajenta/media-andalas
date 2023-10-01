<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = ['post_id', 'ip_address', 'location'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function berita()
    {
        return $this->belongsTo('App\Models\BeritaModel', 'post_id', 'id_berita', 'berita_id');
    }
    
}
