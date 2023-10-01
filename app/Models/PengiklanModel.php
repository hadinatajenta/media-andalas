<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengiklanModel extends Model
{
    use HasFactory;

    protected $table = 'pengiklan';
    protected $primaryKey = 'id_pengiklan';
    protected $fillable = [
        'id_iklan',
        'nama_pengiklan',	
        'no_telp_pengiklan', 	
        'durasi_iklan', 	
        'gambar_iklan',	
        'website',	
        'total_harga',	
        'status',	
        'created_at',	
        'updated_at'	
    ];

    public function iklan()
    {
        return $this->belongsTo('App\Models\IklanModel', 'id_iklan');
    }
    public static function getMonthlyIncomeByYear($year)
{
    $monthlyIncome = PengiklanModel::selectRaw('MONTH(tanggal_masuk) as month, SUM(total_harga) as income')
        ->join('iklan', 'pengiklan.id_iklan', '=', 'iklan.id_iklan')
        ->whereYear('pengiklan.tanggal_masuk', $year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    return $monthlyIncome;
}

}
