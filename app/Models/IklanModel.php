<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IklanModel extends Model
{
    use HasFactory;

    protected $table = 'iklan';
    protected $primaryKey = 'id_iklan';
    protected $fillable = [
        'nama_iklan',
        'harga_iklan',
        'jenis_iklan',
        'created_at',
        'updated_at'
    ];

    
}
