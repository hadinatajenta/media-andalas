<!doctype html>
<html lang="en">
<head>
    <title>Edit Berita</title>
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
        <header class="header">
            <button onclick="window.history.back()" class="back-button">
                <i class='bx bx-arrow-back'></i>
            </button>
            <p class="title">Tambah berita</p>
        </header>

        <!--Main-->
        <main class="px-4 my-2" >
            <form action="{{ route('author.update', ['id' => $berita->id_berita]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" >
                    <!--Text Editor (sebelah kiri)-->
                    <div class="col-lg-9" >
                        <!--Judul Berita-->
                        <div class="col" >
                            <input type="text" id="judul_berita" name="judul_berita" placeholder="Masukkan Judul Berita..." required class="box" value="{{$berita->judul_berita}}">
                        </div>
                        <!--CKEditor-->
                        <div class="box-editor">
                            <textarea name="isi_berita" id="editor" style="display: none;" >{{$berita->isi_berita}}</textarea>
                        </div>

                    </div>

                    <!--Bagian sebelah kanan-->
                    <div class="col-lg-3" style="background-color: #fff; border-radius:10px; border:1px solid #ccced1">
                        <!--Tombol Publikasikan & Simpan sebagai Draft-->
                        <div class="d-flex justify-content-between my-3">
                            <button type="submit" class="btn btn-secondary" name="saveAsDraft">
                                <i class='bx bx-save'></i>&nbsp; Draft
                            </button>
                            <!--Tombol Publikasikan-->
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-send'></i>&nbsp; Publikasikan
                            </button>
                        </div>
                        <!--End Tombol Publikasikan & Simpan sebagai Draft-->

                        <!--Upload Thumbnail-->
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
                        <!--End Upload Thumbnail-->

                        <!--Kategori-->
                        <div class="form-group my-2">
                            <label for="kategori">Pilih kategori</label>
                            <select id="kategori" name="kategori_berita" class="form-control" aria-label="Default select example">
                                @foreach($kategori as $item)
                                    <option value="{{ $item->id_kategori }}" {{ $item->id_kategori == $berita->kategori_berita ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!--End kategori-->

                        <!--Meta Deskripsi-->
                        <div class="form-group my-2">
                            <label for="deskripsi">Deskripsi Berita</label>
                            <input id="deskripsi" type="text" name="deskripsi_berita" placeholder="Masukkan deskripsi pencarian..." class="form-control" value="{{$berita->deskripsi_berita}}" required>
                        </div>

                        <!--Meta Keyword-->
                        <div class="form-group my-2">
                            <label for="deskripsi">Keyword Berita</label>
                            <input id="keyword" type="text" name="keyword_berita" placeholder="Masukkan Keyword (pisahkan dengan tanda koma)" class="form-control" value="{{$berita->keyword_berita}}" required>
                        </div>

                        <!--Pengaturan URL-->
                        <div class="form-group my-2">
                            <label for="autoUrl">Pengaturan URL</label>
                            <!--URL Custom-->
                            <div class="form-check">
                                <input class="form-check-input" disabled type="radio" name="slug" id="customUrl" value="custom">
                                <label class="form-check-label" for="customUrl">
                                    URL Custom
                                </label>
                            </div>
                            <input type="text" id="urlInput" name="slug" class="form-control" disabled placeholder="Masukkan URL custom...">
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
        document.querySelectorAll('input[name="slug"]').forEach((elem) => {
        elem.addEventListener("change", function(event) {
            document.getElementById("urlInput").disabled = event.target.value === "auto";
        });
    });
    </script>

    <!--Script Pengaturan URL Otomatis-->
    <script src="/js/seo-title.js"></script>
</body>
</html>
