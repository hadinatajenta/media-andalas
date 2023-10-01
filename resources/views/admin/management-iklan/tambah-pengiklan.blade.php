<!-- resources/views/iklan/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Iklan</div>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" id="form" action="{{ route('admin.store-pengiklan') }}" enctype="multipart/form-data">
                            @csrf         
                            <!--Nama Pengiklan-->
                            <div class="form-group">
                                <label for="nama_pengiklan">Nama Pengiklan</label>
                                <input id="nama_pengiklan" type="text" class="form-control @error('nama_pengiklan') is-invalid @enderror" name="nama_pengiklan" value="{{ old('nama_pengiklan') }}" required autofocus>
                                @error('nama_pengiklan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--end Nama Pengiklan-->
                            
                            <!--Jenis Iklan-->
                            <div class="form-group my-2">
                                <label for="id_iklan">Jenis Iklan</label>
                                <select id="id_iklan" class="form-control @error('id_iklan') is-invalid @enderror" name="id_iklan" required>
                                    <option value="">Pilih Jenis Iklan</option>
                                    @foreach(App\Models\IklanModel::pluck('nama_iklan', 'id_iklan') as $id => $namaIklan)
                                        <option value="{{ $id }}" {{ old('id_iklan') == $id ? 'selected' : '' }}>{{ $namaIklan }}</option>
                                    @endforeach
                                </select>
                                @error('id_iklan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--end Jenis Iklan-->

                            <!--Notelp Pengiklan-->
                            <div class="form-group my-1">
                                <label for="no_telp_pengiklan">No. Telp</label>
                                <input id="no_telp_pengiklan" type="text" class="form-control @error('no_telp_pengiklan') is-invalid @enderror" name="no_telp_pengiklan" value="{{ old('no_telp_pengiklan') }}" required>
                                @error('no_telp_pengiklan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--end Notelp Pengiklan-->

                            <!--Gambar Iklan-->
                            <div class="form-group my-2">
                                <label for="gambar_iklan">Gambar Iklan</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('gambar_iklan') is-invalid @enderror" id="gambar_iklan" name="gambar_iklan"  required>
                                    @error('gambar_iklan')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <img id="preview" src="#" alt="your image" class="img-thumbnail" style="display: none;"/>
                                </div>
                            </div>
                            <!--End Gambar Iklan-->
          
                            <!--Alamat Website Pengiklan-->
                            <div class="form-group my-2">
                                <label for="website">Website</label>
                                <input id="website" type="url" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }} " placeholder="Masukkan URL dimulai dari http:// atau https://">
                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--end Alamat Website Pengiklan-->

                            <!--Tanggal Masuk dan Tanggal Keluar-->
                            <div class="form-row d-flex row my-2">
                                <div class="form-group col-lg-6 my-2">
                                    <label for="tanggal_masuk">Tanggal Masuk</label>
                                    <input id="tanggal_masuk" type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
                                    @error('tanggal_masuk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 my-2">
                                    <label for="tanggal_keluar">Tanggal Keluar</label>
                                    <input id="tanggal_keluar" type="date" class="form-control @error('tanggal_keluar') is-invalid @enderror" name="tanggal_keluar" value="{{ old('tanggal_keluar') }}" required>
                                    @error('tanggal_keluar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!--end Tanggal Masuk dan Tanggal Keluar-->      
                            <div class="form-group my-2">
                                <label for="total_harga">Total Harga: </label>
                                <span id="total_harga">0</span>
                            </div>        
                            <!--Submit-->
                            <div class="form-group mb-0 my-2">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                            <!--end Submit-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#id_iklan, #tanggal_masuk, #tanggal_keluar').change(function() {
            let idIklan = $('#id_iklan').val();
            let tanggalMasuk = $('#tanggal_masuk').val();
            let tanggalKeluar = $('#tanggal_keluar').val();
            
            if(idIklan != "" && tanggalMasuk != "" && tanggalKeluar != ""){
                $.ajax({
                    url: '{{ route("get.harga.iklan") }}',
                    type: 'POST',
                    data: {
                        id_iklan: idIklan,
                        tanggal_masuk: tanggalMasuk,
                        tanggal_keluar: tanggalKeluar,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response){
                        $('#total_harga').text(response);
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                });
            }
        });
    });
    </script>
@endsection