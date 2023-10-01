<!doctype html>
<html lang="en">
<head>
    <title>Tambah Berita</title>
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
        <header class="d-flex flex-row align-items-center p-1 mb-4" style="background-color: #598381; box-shadow: 0 7px 14px 0 rgba(60, 66, 87, 0.08),
        0 3px 6px 0 rgba(0, 0, 0, 0.12);">
            <button onclick="window.history.back()" class="back-button p-2" style="border:none; background-color:transparent; color:white;">
                <i class='bx bx-arrow-back'></i>
            </button>
            <p class="my-0 mx-1" style="font-size: 22px; font-weight: 500; color: #fff">Tambah berita</p>
        </header>

        <!--Main-->
        <main class="px-4 my-2" >
            <form action="{{ route('status.update', $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" >
                    <!--Text Editor (sebelah kiri)-->
                    <div class="col-lg-9" >
                        <!-- Judul Berita -->
                        <div class="col" >
                            <input type="text" id="judul_berita" name="judul_berita" value="{{ $news->judul_berita }}" required class="box">
                        </div>
                        <!-- CKEditor -->
                        <div class="box-editor">
                            <textarea name="isi_berita" id="editor">{{ $news->isi_berita }}</textarea>
                        </div>

                    </div>

                    <!--Bagian sebelah kanan-->
                    <div class="col-lg-3" style="background-color: #fff; border-radius:10px; border:1px solid #ccced1">
                        <div class="d-flex justify-content-between my-3">
                            <!--Tombol Simpan sebagai Draft-->
                            <button type="submit" class="btn btn-secondary" name="saveAsDraft">
                                <i class='bx bx-save'></i>&nbsp; Save as Draft
                            </button>
                            <!--Tombol Publikasikan-->
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-send'></i>&nbsp; Publikasikan
                            </button>
                        </div>

                        <!-- Upload Thumbnail -->
                        <div class="form-group my-2">
                            <label for="formFile" class="form-label">Upload thumbnail</label>
                            <input class="form-control" name="gambar_berita" type="file" id="formFile" value="{{ $news->gambar_berita }}">
                        </div>

                        <!-- Kategori -->
                        <div class="form-group my-2">
                            <label for="kategori">Pilih kategori</label>
                            <select id="kategori" name="kategori_berita" class="form-control" aria-label="Default select example">
                                <option selected>Pilih kategori</option>
                                
                                @foreach($categories as $item)
                                    <option value="{{ $item->id_kategori }}" {{ $news->kategori->id_kategori == $item->id_kategori ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>
                                @endforeach


                            </select>
                        </div>

                        <!-- Deskripsi Berita -->
                        <div class="form-group my-2">
                            <label for="deskripsi">Deskripsi Berita</label>
                            <input id="deskripsi" type="text" name="deskripsi_berita" value="{{ $news->deskripsi_berita }}" class="form-control" required>
                        </div>

                        <!-- Keyword -->
                        <div class="form-group my-2">
                            <label for="deskripsi">Deskripsi Berita</label>
                            <input id="keyword" type="text" name="keyword_berita" value="{{ $news->keyword_berita }}" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between my-3">
                            <!--Tombol Tolak-->
                            <button type="submit" class="btn btn-danger" name="reject">
                                <i class='bx bx-x'></i>&nbsp; Tolak
                            </button>
                            <!--Tombol Setujui-->
                            <button type="submit" class="btn btn-success">
                                <i class='bx bx-check'></i>&nbsp; Setujui
                            </button>
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
