<!doctype html>
<html lang="en">
<head>
    <title>Detail berita menunggu persetujuan</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Style CKEDITOR 5 -->
    <link rel="stylesheet" href="/css/ckeditor.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!--Box ICONS-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body style="background-color: #f7fafc">
    <div class="container-fluid p-0">
        <!--Header-->   
        <header class="d-flex flex-row align-items-center p-1 mb-4">
            <button onclick="window.history.back()" class="back-button p-2" style="border:none; background-color:transparent;  ">
                <i class='bx bx-arrow-back'></i>
            </button>
            <p class="my-0 mx-1" style="font-size: 22px; font-weight: 500;">Tambah berita</p>
        </header>

        <!--Main-->
        <main class="px-4 my-2" >
            <form method="POST" id="beritaForm" action="{{ route('admin.berita.update', ['id' => $berita->id_berita]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" >
                    <!--Text Editor (sebelah kiri)-->
                    <div class="col-lg-9" >
                        <!--Judul Berita-->
                        <div class="col">
                            <input type="text" id="judul_berita" name="judul_berita" value="{{ $berita->judul_berita }}" placeholder="Masukkan Judul Berita..." required class="box">
                        </div>
                        <!--CKEditor-->
                        <div class="box-editor">
                            <textarea name="isi_berita" id="editor">{{ $berita->isi_berita }}</textarea>
                        </div>

                    </div>

                    <!--Bagian sebelah kanan-->
                    <div class="col-lg-3" style="background-color: #fff; border-radius:10px; border:1px solid #ccced1">
                        <div class="d-flex justify-content-between my-3">
                            <!--Tombol Simpan sebagai Draft-->
                            <button type="submit" class="btn btn-secondary" name="saveAsDraft">
                                <i class='bx bx-save'></i>&nbsp; Save as Draft
                            </button>

                            <!--Tombol Setujui berita-->
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-send'></i>&nbsp; Setujui
                            </button>
                        </div>

                        <!-- Upload Thumbnail -->
                        <div class="form-group my-2">
                            <label for="formFile" class="form-label">Upload thumbnail</label>
                            <img src="{{ Storage::url('berita/' . $berita->gambar_berita) }}" alt="{{ $berita->judul_berita }}" class="img-fluid mb-2">
                            <input class="form-control" name="gambar_berita" type="file" id="formFile">
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!--Kategori-->
                        <div class="form-group my-2">
                            <label for="kategori">Pilih kategori</label>
                            <select id="kategori" name="kategori_berita"  class="form-control" aria-label="Default select example">
                                <option selected value="">Pilih kategori</option>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->id_kategori }}" {{ $berita->kategori_berita == $item->id_kategori ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>
                                @endforeach

                            </select>
                        </div>
                        <!--Youtube Link-->
                        <div class="form-group my-2">
                            <label for="youtube_link">Link YouTube</label>
                            <input id="youtube_link" style="font-size: 14px" type="text" name="youtube_link" value="{{$berita->youtube_link}}" placeholder="Masukkan Link YouTube" class="form-control">
                        </div>
                        <!--Meta Deskripsi-->
                        <div class="form-group my-2">
                            <label for="deskripsi">Deskripsi Berita</label>
                            <input id="deskripsi" type="text" name="deskripsi_berita" value="{{ $berita->deskripsi_berita }}" placeholder="Masukkan deskripsi pencarian..." class="form-control" required>
                        </div>

                        <!--Meta Keyword-->
                        <div class="form-group my-2">
                            <label for="deskripsi">Keyword Berita</label>
                            <input id="keyword" type="text" name="keyword_berita" value="{{ $berita->keyword_berita }}" placeholder="Masukkan Keyword..." class="form-control" required>
                        </div>
                    </div>

                </div>
            </form>
            
        </main>

    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <!--CKEditor 5-->
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>
    
    <script src="/js/ckeditor.js"></script>

    <!--Script untuk pengaturan URL-->
   
    <script>
        const beritaForm = document.getElementById('beritaForm');
        const urlInput = document.getElementById('urlInput');
        const customUrlRadio = document.getElementById('customUrl');
        
        beritaForm.addEventListener('submit', function(e) {
            if (customUrlRadio.checked && urlInput.value.trim() === '') {
                e.preventDefault();
                alert('URL tidak boleh kosong');
            }
        });

        document.querySelectorAll('input[name="slug"]').forEach((elem) => {
            elem.addEventListener("change", function(event) {
                urlInput.disabled = event.target.value === "auto";
                urlInput.required = event.target.value === "custom";
            });
        });
    </script>

    

    <!--Script Pengaturan URL Otomatis-->
    <script src="/js/seo-title.js"></script>
</body>
</html>
