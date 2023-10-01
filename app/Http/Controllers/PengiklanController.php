<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengiklanModel;
use App\Models\IklanModel;
use Carbon\Carbon;
use App\Rules\ImageDimensionsRule;
use Illuminate\Support\Facades\File;


class PengiklanController extends Controller
{
    //Halaman tambah pengiklan
    public function create()
    {
        $iklan = IklanModel::all();
        return view('admin.management-iklan.tambah-pengiklan', compact('iklan'));
    }
    //Minyimpan data pengiklan
    public function store(Request $request)
    {
        $sekarang = Carbon::now();

        $pesanError = [
            'tanggal_masuk.after_or_equal' => 'Tanggal masuk harus hari ini atau di hari kedepan.',
            'tanggal_keluar.after' => 'Tanggal keluar tidak boleh hari kemarin.',
            'no_telp_pengiklan.numeric' => 'Nomor telepon harus berisi angka.',
        ];
        $request->validate([
            'nama_pengiklan' => 'required',
            'no_telp_pengiklan' => 'required|numeric',
            'id_iklan' => 'required|exists:iklan,id_iklan',
            'tanggal_masuk' => 'required|date|after_or_equal:' . $sekarang->toDateString(),
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
            'gambar_iklan' => ['required', 'image', new ImageDimensionsRule($request->id_iklan)],
            'website' => 'nullable|url',
        ],$pesanError);

        // Mengambil data iklan dari IklanModel
        $iklan = IklanModel::find($request->id_iklan);

        // Menghitung durasi iklan
        $tanggalMasuk = Carbon::parse($request->tanggal_masuk);
        $tanggalKeluar = Carbon::parse($request->tanggal_keluar);
        $durasi = $tanggalMasuk->diffInDays($tanggalKeluar);

        // Menghitung harga total dari tanggal masuk dan tanggal keluar x  harga iklan
        $totalHarga = $durasi * $iklan->harga_iklan;
        
        // Menentukan status berdasarkan tanggal masuk dan tanggal keluar
        $sekarang = Carbon::now();

        if ($tanggalMasuk <= $sekarang && $tanggalKeluar >= $sekarang) {
            // Iklan sedang berjalan
            $status = 'berjalan';
        } else if ($tanggalMasuk > $sekarang) {
            // Iklan masih menunggu untuk berjalan
            $status = 'menunggu';
        } else {
            // Iklan telah selesai
            $status = 'selesai';
        }
         // Cek jika ada iklan dengan jenis yang sama dan masih berjalan
        $iklanBerjalan = PengiklanModel::where('id_iklan', $request->id_iklan)
            ->where('status', 'berjalan')
            ->exists();

        if($iklanBerjalan && $status == 'berjalan'){
            return back()->with('error', 'Tidak dapat menambahkan iklan baru karena masih ada iklan berjalan');
        }
        
        // Menambahkan data pengiklan
        $pengiklan = new PengiklanModel();
        $pengiklan->nama_pengiklan = $request->nama_pengiklan;
        $pengiklan->no_telp_pengiklan = $request->no_telp_pengiklan;
        $pengiklan->id_iklan = $request->id_iklan;
        $pengiklan->tanggal_masuk = $tanggalMasuk;
        $pengiklan->tanggal_keluar = $tanggalKeluar;
        $pengiklan->total_harga = $totalHarga;
        $pengiklan->status = $status;

        // Menghandle upload gambar
        if ($request->hasFile('gambar_iklan')) {
            $fileName = time() . '.' . $request->gambar_iklan->getClientOriginalExtension();
            $request->gambar_iklan->move(public_path('uploads'), $fileName);
            $pengiklan->gambar_iklan = $fileName;
        }

        $pengiklan->website = $request->website;
        $pengiklan->save();

        //kembali ke halaman iklan
        return redirect()->route('admin.iklan')->with('success', 'Data pengiklan berhasil ditambahkan');
    }
    public function getHargaIklan(Request $request){
        $iklan = IklanModel::find($request->id_iklan);
        $tanggalMasuk = Carbon::parse($request->tanggal_masuk);
        $tanggalKeluar = Carbon::parse($request->tanggal_keluar);
        $durasi = $tanggalMasuk->diffInDays($tanggalKeluar);

        // Menghitung harga total dari tanggal masuk dan tanggal keluar x  harga iklan
        $totalHarga = $durasi * $iklan->harga_iklan;

        return response()->json($totalHarga);
    }

    //Halaman Edit Pengiklan
    public function edit($id_pengiklan)
    {
        $pengiklan = PengiklanModel::findOrFail($id_pengiklan);
        $iklan = IklanModel::all();

        return view('admin.management-iklan.edit-pengiklan', compact('pengiklan', 'iklan'));
    }
    //Update Data pengiklan
    public function update(Request $request, $id_pengiklan)
    {
        $sekarang = Carbon::now();

        $pesanError = [
            'tanggal_masuk.after_or_equal' => 'Tanggal masuk harus hari ini atau di hari kedepan.',
            'tanggal_keluar.after' => 'Tanggal keluar tidak boleh hari kemarin.',
            'no_telp_pengiklan.numeric' => 'Nomor telepon harus berisi angka.',
        ];
        $request->validate([
            'nama_pengiklan' => 'required',
            'no_telp_pengiklan' => 'required|numeric',
            'id_iklan' => 'required|exists:iklan,id_iklan',
            'tanggal_masuk' => 'required|date|after_or_equal:' . $sekarang->toDateString(),
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
            'gambar_iklan' => ['nullable', 'image', new ImageDimensionsRule($request->id_iklan)],
            'website' => 'nullable|url',
        ], $pesanError);

        // Mengambil data iklan dari IklanModel
        $iklan = IklanModel::find($request->id_iklan);

        // Menghitung durasi iklan
        $tanggalMasuk = Carbon::parse($request->tanggal_masuk);
        $tanggalKeluar = Carbon::parse($request->tanggal_keluar);
        $durasi = $tanggalMasuk->diffInDays($tanggalKeluar);

        // Menghitung harga total dari tanggal masuk dan tanggal keluar x harga iklan
        $totalHarga = $durasi * $iklan->harga_iklan;

        // Menentukan status berdasarkan tanggal masuk dan tanggal keluar
        $sekarang = Carbon::now();

        if ($tanggalMasuk <= $sekarang && $tanggalKeluar >= $sekarang) {
            // Iklan sedang berjalan
            $status = 'berjalan';
        } else if ($tanggalMasuk > $sekarang) {
            // Iklan masih menunggu untuk berjalan
            $status = 'menunggu';
        } else {
            // Iklan telah selesai
            $status = 'selesai';
        }

        // Cek jika ada iklan dengan jenis yang sama dan masih berjalan
        $iklanBerjalan = PengiklanModel::where('id_iklan', $request->id_iklan)
            ->where('status', 'berjalan')
            ->where('id_pengiklan', '!=', $id_pengiklan)
            ->exists();

        if ($iklanBerjalan && $status == 'berjalan') {
            return back()->with('error', 'Tidak dapat mengupdate pengiklan karena masih ada iklan berjalan dengan jenis yang sama');
        }

        // Mengambil data pengiklan yang akan diupdate
        $pengiklan = PengiklanModel::findOrFail($id_pengiklan);
        $pengiklan->nama_pengiklan = $request->nama_pengiklan;
        $pengiklan->no_telp_pengiklan = $request->no_telp_pengiklan;
        $pengiklan->id_iklan = $request->id_iklan;
        $pengiklan->tanggal_masuk = $tanggalMasuk;
        $pengiklan->tanggal_keluar = $tanggalKeluar;
        $pengiklan->total_harga = $totalHarga;
        $pengiklan->status = $status;

        // Menghandle upload gambar jika ada perubahan
        if ($request->hasFile('gambar_iklan')) {
            $fileName = time() . '.' . $request->gambar_iklan->getClientOriginalExtension();
            $request->gambar_iklan->move(public_path('uploads'), $fileName);

            // Menghapus gambar lama jika ada
            if ($pengiklan->gambar_iklan) {
                File::delete(public_path('uploads/' . $pengiklan->gambar_iklan));
            }

            $pengiklan->gambar_iklan = $fileName;
        }

        $pengiklan->website = $request->website;
        $pengiklan->save();

        return redirect()->route('admin.management-iklan.iklan')->with('success', 'Data pengiklan berhasil diupdate');
    }

}
