@extends('layouts.appAuthor')

@section('title','Pengaturan profil')

@section('content')
    <div class="container">     
        <div class="row" style="border-radius: 20px;">
            <!--Kiri-->
            <div class="col-md-4 p-2" style="background-color: white; color:#24252a; border-right:1px solid #eaeaea">
                <div class="btn p-2 w-100" style="background-color:#e9f0ff; border:1px solid #eaeaea">
                    <div class=" d-flex my-1" style="color:#2c72fe; text-decoration:none;"><i class='bx bxs-edit bx-sm'></i> &nbsp; Edit profile</div>
                </div>
            </div>

            <!--Kanan-->
            <div class="col-md-8 p-2" style="background-color: white; color:#24252a;" >
                <h4 class="p-2">Profile saya</h4>
                <form class="p-2" action="{{ route('author.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="form-group p-4 d-flex align-items-center" style="border:1px solid #eaeaea; border-radius:10px">
                        <div style="position: relative; display: inline-block;">
                            <label for="foto_profil">
                                <img id="preview" src="{{ asset('storage/' . $user->foto_profil) ?? 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}" style="height:100px; width:100px; border-radius:50%">
                                <input type="file" id="foto_profil" name="foto_profil" accept="image/*" style="display: none;"/>
                                <div style="position: absolute; bottom: 0; left: 0; right: 0; background-color: rgba(0,0,0,0.6); color: white; text-align: center; padding: 5px;">
                                    Ganti Foto
                                </div>
                            </label>
                        </div>
                        &nbsp;
                        <div class="mx-2">
                            <h4>{{$user->name}} {{$user->last_name}}</h4>
                            <p class="text-secondary m-0 text-capitalize">{{$user->role}}</p>
                            <p class="text-secondary m-0">{{$user->alamat}}</p>
                        </div>
                    </div>
                    
                    <div class="form-group mt-4 p-3" style="border-radius:10px; border:1px solid #eaeaea;">
                        <h4>Informasi pribadi</h4>
                        <div class="row mb-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="text-secondary">Nama</label> 
                                    <input class="form-control" type="text" name="name" value="{{$user->name}}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="text-secondary">Nama Akhir</label> 
                                    <input class="form-control" type="text" name="last_name" value="{{$user->last_name}}" placeholder="Opsional">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="text-secondary">Email</label> 
                                    <input class="form-control" type="text" name="email" value="{{$user->email}}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="text-secondary">No Telp</label> 
                                    <input class="form-control" type="number" name="no_telp" value="{{$user->no_telp}}" placeholder="No telp / ponsel">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="text-secondary">Bio</label> 
                                    <input class="form-control" type="text" name="bio" value="{{$user->bio}}" placeholder="Tentang anda...">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="text-secondary">Nomor Pegawai</label> 
                                    <input class="form-control" type="text" name="nomor_pegawai" value="{{$user->nomor_pegawai}}" placeholder="Ex: 18031006300030">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="form-group mt-4 p-3" style="border: 1px solid #eaeaea; border-radius:10px">
                        <h4>Alamat</h4>
                        <div class="row mb-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="text-secondary">Kota</label> 
                                    <input class="form-control" type="text" name="kota" value="{{$user->kota}}" placeholder="Ex: Bandar Lampung">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="text-secondary">Alamat</label> 
                                    <input class="form-control" type="text" name="alamat" value="{{$user->alamat}}" placeholder="Ex: Jl Pramuniaga 3 No 88">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="text-secondary">Kode Pos</label> 
                                    <input class="form-control" type="text" name="kode_pos" value="{{$user->kode_pos}}" placeholder="Ex: 34523">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4 p-3" style="border: 1px solid #eaeaea; border-radius:10px">
                        <h4>Sosmed</h4>
                        <div class="row mb-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <i class='bx bxl-facebook bx-sm' style="color: #1877F2"></i>
                                    <label for="name" class="text-secondary">Facebook</label> 
                                    <input class="form-control" type="text" name="link_fb" value="{{$user->link_fb}}" placeholder="Link facebook ">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <i class='bx bxl-twitter bx-sm' style="color: #1DA1F2"></i>
                                    <label for="name" class="text-secondary">Twitter</label> 
                                    <input class="form-control" type="text" name="link_twitter" value="{{$user->link_twitter}}" placeholder="Link Twiitter">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <i class='bx bxl-youtube bx-sm' style="color: #FF0000"></i>
                                    <label for="name" class="text-secondary">YouTube</label> 
                                    <input class="form-control" type="text" name="link_youtube" value="{{$user->link_youtube}}" placeholder="Link YouTube">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn mt-2" style="background-color: #5a7af9; color:white;">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script>
    function previewImage() {
        var file = document.getElementById("foto_profil").files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            document.getElementById("preview").src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            document.getElementById("preview").src = "";
        }
    }
</script>
@endsection