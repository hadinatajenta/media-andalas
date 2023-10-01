@extends('layouts.appAuthor')

@section('content')
    <div class="container">
        <div class="row my-4" >
            <div class="col">
                <div class="card p-2">
                    <div class=" d-flex align-items-center justify-content-between card-header ">
                        <div class="judul">
                            <h4>Daftar berita</h4>
                            <p class="p-0 m-0">Seluruh berita dengan semua status </p>
                        </div>
                        <form action="{{ route('author.dashboard') }}" method="GET" class="d-flex my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Cari Berita" aria-label="Cari Berita" name="search">
                            <button class="btn btn-outline-success my-2 my-sm-0" style="height: calc(1.5em + .75rem + 2px);" type="submit"><i class='bx bx-search-alt-2'></i></button>
                        </form>
                        <a href="{{ route('author.tambah-berita') }}" class="btn" style="background-color: #5a7af9; color:white; font-size:12px;">+ Tambah berita</a>

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
                                        <td class="align-middle">{{ $item->author->name }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('author.edit', $item->id_berita) }}" class="btn edit-kategori" >  
                                                <i class='bx bxs-pencil'></i> &nbsp; Edit
                                            </a>
                                            <form id="delete-form-{{ $item->id_berita }}" action="{{ route('author.destroy', ['id' => $item->id_berita]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Hapus" onclick="event.preventDefault();">
                                            </form>
                                            <a href="{{route('author.destroy',$item->id_berita)}}" class="btn hapus-kategori" onclick="
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
        <div class="d-flex justify-content-center mt-2">
            {{ $berita->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
