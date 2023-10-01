<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IklanModel;
use App\Models\PengiklanModel;

class IklanController extends Controller
{
    public function index(Request $request)
    {
        $order = $request->query('order');
        $status = $request->query('status');
        // Mengambil parameter 'status' dari query string.

        $iklans = IklanModel::all();

        if ($order === 'asc') {
            $pengiklanQuery = PengiklanModel::orderBy('tanggal_masuk', 'asc');
        } else {
            $pengiklanQuery = PengiklanModel::orderBy('tanggal_masuk', 'desc');
        }

        // Jika status di-set, tambahkan ke query
        if ($status && $status !== 'all') {
            $pengiklanQuery->where('status', $status);
        }

        $pengiklan = $pengiklanQuery->get();

        $currentYear = $request->input('year', date('Y'));

        return view('admin.management-iklan.iklan', compact('iklans', 'pengiklan', 'currentYear', 'order', 'status'));
    }


    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'nama_iklan' => 'required',
            'harga_iklan' => 'required|numeric',
            'jenis_iklan' => 'required',
        ]);

        // Temukan iklan berdasarkan ID
        $iklan = IklanModel::findOrFail($id);

        // Update iklan dengan data dari request
        $iklan->update($request->all());

        // Redirect ke halaman admin.iklan dengan pesan sukses
        return redirect()->route('admin.iklan')->with('success', 'Iklan berhasil diupdate!');
    }

    
}
