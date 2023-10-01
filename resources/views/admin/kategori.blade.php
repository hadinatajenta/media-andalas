@extends('layouts.app')

@section('content')
<div class="container p-4"  style="background-color: #fff; border-radius:10px;">
    <!--Tambah-->
    <div class="d-flex justify-content-between align-items-center mb-3 ">
        <h4 class="mb-0">Kategori</h4>
        <button type="button" class="btn tambah-kategori" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class='bx bx-plus'></i>&nbsp; kategori baru</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--Modal header-->
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!--Modal body-->
                <div class="modal-body">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" aria-describedby="nama_kategori" placeholder="Masukkan Nama Kategori">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--List Kategori-->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kategori</th>
                    <th scope="col" style="text-align:center">Jumlah Berita</th>
                    <th scope="col" style="text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $index => $item)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $item->nama_kategori }}</td>
                    <td style="text-align:center">{{ $item->berita_count}}</td>
                    <td style="text-align:center">
                        <button class="btn edit-kategori" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $item->id }}"><i class='bx bxs-pencil'></i> &nbsp; Edit</button>
                        <form action="{{ route('kategori.destroy', $item->id_kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah yakin akan menghapus kategori berikut?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn hapus-kategori" type="submit"><i class='bx bx-trash' ></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Edit modals -->
    @foreach ($kategori as $index => $item)
    <div class="modal fade" id="editCategoryModal{{ $item->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel{{ $item->id }}">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori.update', $item->id_kategori) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" aria-describedby="nama_kategori" value="{{ $item->nama_kategori }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
