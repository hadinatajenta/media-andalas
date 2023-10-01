@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mt-2">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="p-2" style="background-color: white">
                            <form action="{{ route('admin.pengaturan-website.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="informasi-website">
                                    <h4>Informasi Website</h4>
                                    <div class="form-group my-3 row">
                                        <label for="nama_website" class="form-label">Nama Website</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="nama_website" name="nama_website" value="{{ $website->nama_website ?? '' }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="form-text">*Nama website akan ditampilkan sebagai Nama utama website, berhati-hatilah saat mengganti nama website akan mengakibatkan penurunan performa website</p>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="deskripsi_website" class=" col-form-label">Deskripsi Website</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" id="deskripsi_website" name="deskripsi_website" rows="5">{{ $website->deskripsi_website ?? '' }}</textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="form-text">*Deskripsi website akan ditampilkan di bagian informasi website, cermatlah saat menuliskan deskripsi ini.</p>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="keyword_website" class=" col-form-label">Kata Kunci Website</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="keyword_website" name="keyword_website" value="{{ $website->keyword_website ?? '' }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="form-text">8Kata kunci website akan digunakan oleh mesin pencari untuk mengindeks halaman Anda, gunakan kata kunci yang relevan.</p>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="robot_txt" class=" col-form-label">Robot.txt</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" id="robot_txt" name="robot_txt" rows="5">{{ $website->robot_txt ?? '' }}</textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="form-text">Robot.txt digunakan untuk memberi instruksi kepada mesin pencari tentang halaman mana yang boleh atau tidak boleh diindeks.</p>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="favicon" class="col-form-label">Favicon</label>
                                        <div class="col-sm-6">
                                            <input type="file" class="form-control" id="favicon" name="favicon">
                                            @if($website->favicon)
                                                <img src="data:image/png;base64,{{ $website->favicon }}" alt="Favicon" style="width: 32px; height: 32px;">
                                            @endif
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="form-text">Favicon adalah ikon kecil yang muncul di tab browser di samping judul situs web Anda.</p>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="informasi-perusahaan">
                                    <h4>Informasi perusahaan</h4>
                                    <div class="form-group  my-3"">
                                        <label for="no_telp" class="form-label">No Telp</label>
                                        <input type="text" class="form-control" id="notelp" name="no_telp" value="{{ $website->no_telp ?? '' }}" placeholder="Tambahkan nomor telepon perusahaan">
                                    </div>
                                    <div class="form-group  mb-3"">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $website->alamat ?? '' }}" placeholder="Tambahkan alamat perusahaan">
                                    </div>
                                    <div class="form-group  mb-3"">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $website->email ?? '' }}" placeholder="Tambahkan email perusahaan">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
