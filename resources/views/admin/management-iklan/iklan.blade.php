@extends('layouts.app')

@section('title','Iklan')

@section('content')

<div class="container my-4 ">
    <div class="row">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
        @endif
        @foreach ($iklans as $iklan)
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $iklan->nama_iklan }}</h5>
                    <p class="card-text">{{ $iklan->jenis_iklan }}</p>
                    <p class="card-text">Rp {{ number_format($iklan->harga_iklan, 0, ',', '.') }}/ hari</p>
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editModal-{{ $iklan->id_iklan }}">
                        Edit
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Modal Edit -->
        <div class="modal fade" id="editModal-{{ $iklan->id_iklan }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $iklan->id_iklan }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel-{{ $iklan->id_iklan }}">Edit Iklan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.iklan.update', $iklan->id_iklan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label>Nama Iklan</label>
                                <input type="text" class="form-control" name="nama_iklan" value="{{ $iklan->nama_iklan }}" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Iklan</label>
                                <input type="text" class="form-control" name="jenis_iklan" value="{{ $iklan->jenis_iklan }}" required>
                            </div>
                           <div class="form-group">
                                <label>Harga iklan per hari</label>
                                <input type="decimal" class="form-control" name="harga_iklan" value="{{ $iklan->harga_iklan }}" required>
                            </div>
                       
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        
        <div class="col-md-4">
            <div class="card-body h-100 d-flex align-items-center justify-content-center" style="background-color: #5a7af9; border-radius: 0.25rem">
                <a class="btn d-flex align-items-center justify-content-center" style="color: white" >
                    <i class='bx bx-pencil bx-sm'></i> &nbsp;
                    <p class="mb-0">Edit jenis Iklan</p>
                </a>
            </div>
        </div>
    </div>
    <!-- Display advertiser information and ad addition menu -->
    <div class="row mt-2">
        <div class="col-md-12 my-2">
            <div class="card opening p-2">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color:white;color:black;">
                    <div>
                        <h1 class="h2" style="font-size: 22px">Informasi Pengiklan</h1>
                        <p style="color: #8693a0; font-size:14px;">Semua informasi pengiklan atau tambahkan pengiklan baru</p>
                    </div>
                    <a href="{{ route('admin.tambah-pengiklan') }}" class="btn" style="background-color: #5a7af9; color:white; font-size:12px;">+ Tambah pengiklan</a>
                </div>
                <div class="card-body border-none table-responsive scrollable-table">
                    <table class="table table-hover text-nowrap">
                        <thead class="thead-dark">
                            <tr>
                                <th class="px-3">Nama Pengiklan</th>
                                <th class="px-3 d-flex align-items-center">
                                    Periode
                                     
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="periodFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bx bx-filter'></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="{{ route('admin.iklan') . '?order=asc' }}" @if($order === 'asc') selected @endif>Terbaru</a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.iklan') . '?order=desc' }}" @if($order === 'desc') selected @endif>Terlama</a></li>
                                        </ul>
                                    </div>
                                </th>

                                <th class="px-3">Total Harga</th>
                                <th class="px-3 d-flex align-items-center justify-content-between">
                                    Status
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="statusFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bx bx-filter'></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="{{ route('admin.iklan') . '?status=all' }}" @if($status === 'all' || !$status) selected @endif>Semua</a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.iklan') . '?status=menunggu' }}" @if($status === 'menunggu') selected @endif>Menunggu</a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.iklan') . '?status=berjalan' }}" @if($status === 'berjalan') selected @endif>Berjalan</a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.iklan') . '?status=selesai' }}" @if($status === 'selesai') selected @endif>Selesai</a></li>
                                        </ul>
                                    </div>
                                </th>

                                <th class="px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengiklan as $data)
                            <tr>
                                <td class="px-3">{{ $data->nama_pengiklan }}</td>
                                <td class="px-3">{{ date('d M Y', strtotime($data->tanggal_masuk)) }} - {{ date('d M Y', strtotime($data->tanggal_keluar)) }}</td>
                                <td class="px-3">Rp &nbsp;{{ number_format($data->total_harga, 2, ',', '.') }}</td>
                                <td>
                                    @if ($data->status == 'berjalan')
                                    <span class="badge" style="color: #007bff; border:1px solid #a6cfff; background-color:#f2f8ff; border-radius :10px">Berjalan</span>
                                    @elseif ($data->status == 'menunggu')
                                    <span class="badge" style="color: #ffc107; border:1px solid #fff3cd; background-color:#fffdf7; border-radius :10px">Menunggu</span>
                                    @else
                                    <span class="badge" style="color: #28a745; border:1px solid #c3e6cb; background-color:#f2fdf7; border-radius :10px">Selesai</span>
                                    @endif
                                </td>
                                <td class="px-3">
                                    <a href="{{ route('admin.edit-pengiklan', $data->id_pengiklan) }}" class="btn">
                                        <i class='bx bx-pencil'></i> 
                                    </a>
                                </td>
                                <div class="px-3">
                                    <!--Delete-->
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#periodFilter').on('change', function() {
            window.location.href = $(this).val();
        });
    });

    </script>

@endsection
