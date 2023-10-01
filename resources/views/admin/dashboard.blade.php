@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.dashboard', ['status' => 'published']) }}" style="text-decoration: none; color:black;" class="notif card p-2">
                <div class="card-header d-flex align-items-center">
                    <i class="bx bx-check-circle p-2 bx-sm ceklis" ></i>
                    &nbsp;
                    <p class="p-0 m-0" style="font-weight: 500">Berita dipublikasikan</p>
                </div>
                <div class="card-body">
                    <h2>{{$dipublikasikan}} </h2>
                    <div class="d-flex align-items-center mb-0 pb-0">
                        <p class="p-0 m-0">Total berita di publikasikan</p>
                    </div>
                </div>
            </a>
        </div>
        <div class=" col-md-4">
            <a href="{{ route('admin.dashboard', ['status' => 'waiting']) }}" style="text-decoration: none; color:black;" class="notif card p-2">
                <div class="card-header d-flex align-items-center">
                    <i class="bx bx-time-five p-2 bx-sm waktu" style=";"></i>
                    &nbsp;
                    <p class="p-0 m-0" style="font-weight: 500">Berita menunggu</p>
                </div>
                <div class="card-body">
                    <h2>{{$jumlahBeritaMenunggu}} </h2>
                    <div class="d-flex align-items-center mb-0 pb-0">
                        <p class="p-0 m-0">Total berita menunggu</p>
                    </div>
                </div>
            </a>
        </div>
        <div class=" col-md-4">
            <div class=" card p-2">
                <div class="card-header d-flex align-items-center">
                    <i class="bx bx-folder-open p-2 bx-sm kategori"></i>
                    &nbsp;
                    <p class="p-0 m-0" style="font-weight: 500">Total kategori</p>
                </div>
                <div class="card-body">
                    <h2>{{$totalkategori}} </h2>
                    <div class="d-flex align-items-center mb-0 pb-0">
                        <p class="p-0 m-0" >Total seluruh kategori</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4" >
        <div class="col">
            <div class="card p-2">
               <div class="row align-items-center justify-content-between card-header">
                    <div class="col-md-6">
                        <div class="judul">
                            <h4>Daftar berita</h4>
                            <p class="p-0 m-0">Seluruh berita dengan semua status</p>
                        </div>
                    </div>
                    <div class="col-md-4 my-2 my-md-0">
                        <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex">
                            <input class="form-control mr-sm-2" type="search" placeholder="Cari Berita" aria-label="Cari Berita" name="search">
                            <button class="btn btn-outline-success my-2 my-sm-0" style="height: calc(1.5em + .75rem + 2px);" type="submit"><i class='bx bx-search-alt-2'></i></button>
                        </form>
                    </div>
                    <div class="col-md-2 my-2 my-md-0">
                        <a href="{{ route('admin.create') }}" class="btn" style="background-color: #5a7af9; color:white; font-size:12px;">+ Tambah berita</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="background-color: #fff; border-radius:10px;">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @elseif(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="th" scope="col">Judul Berita</th>
                                    <th class="th" scope="col">Kategori</th>
                                    <th class="th" scope="col" style="text-align: center">Featured</th>
                                    <th class="th" scope="col">Status</th>
                                    <th class="th" scope="col">Author</th>
                                    <th class="th" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($berita->isEmpty())
                                    <tr>
                                        <td colspan="6" style="text-align:center">Tidak ada berita menunggu</td>
                                    </tr>
                                @else
                                @foreach ($berita as $item)
                                <tr>
                                    <td class="align-middle" style="max-width: 250px;  overflow: hidden; text-overflow: ellipsis;">{{ $item->judul_berita }}</td>
                                    <td class="align-middle">{{ $item->kategori->nama_kategori ?? 'N/A' }}</td>
                                    <td class="align-middle" style="text-align: center">
                                        @if($item->status == 'Published')
                                            @if($item->featured)
                                                <a href="{{ route('admin.removeFeatured', $item->id_berita) }}" class="btn"><i class='bx bx-x bx-sm x'></i></a>
                                            @else
                                                <a href="{{ route('admin.makeFeatured', $item->id_berita) }}" class="btn"><i class='bx bx-check bx-sm check'></i></a>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td class="align-middle">
                                        <div class="p-2 d-flex align-items-center" style="border:1px solid #eaeaea; color:black; border-radius:5px; font-size:12px;">
                                            <i class='bx bxs-circle' 
                                            style="color:
                                            @if($item->status == 'Published')
                                                #22b07d
                                            @elseif($item->status == 'waiting')
                                                #FFC107
                                            @elseif($item->status == 'ditolak')
                                                #db1731
                                            @elseif($item->status == 'draft')
                                                #007bff
                                            @endif;">
                                            </i>
                                            &nbsp;
                                            <p class="m-0">{{$item->status}}</p>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $item->author ? $item->author->name : 'Unknown' }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.berita.detail', $item->id_berita) }}" class="btn edit-kategori" >  
                                            <i class='bx bxs-pencil'></i> &nbsp; Edit
                                        </a>
                                        <form id="delete-form-{{ $item->id_berita }}" action="{{ route('admin.destroy', ['id' => $item->id_berita]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{route('admin.destroy',$item->id_berita)}}" class="btn hapus-kategori" onclick="
                                                event.preventDefault();
                                                if(confirm('Anda yakin ingin menghapus berita ini?')) {
                                                    document.getElementById('delete-form-{{ $item->id_berita }}').submit();
                                                }">
                                                <i class='bx bx-trash' ></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-2">
        {{ $berita->links('vendor.pagination.bootstrap-4') }}
    </div>
    <!-- End Pagination -->
</div>
<script>
    setTimeout(function(){
        $('.alert').fadeOut('slow');
    }, 5000); // <-- waktu dalam milidetik
</script>

@endsection


