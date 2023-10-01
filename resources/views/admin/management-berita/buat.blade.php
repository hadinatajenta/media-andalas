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
        <header class="header">
            <button onclick="window.history.back()" class="back-button">
                <i class='bx bx-arrow-back'></i>
            </button>
            <p class="title">Tambah berita</p>
        </header>

        <!--Main-->
        <main class="px-4 my-2" >
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                
                @csrf
                <div class="row" >
                    <!--Text Editor (sebelah kiri)-->
                    <div class="col-lg-9" >
                        <!--Judul Berita-->
                        <div class="col">
                            <input type="text" id="judul_berita" name="judul_berita" placeholder="Masukkan Judul Berita..." required class="box"
                            style="border-radius:5px">
                        </div>
                        <!--CKEditor-->
                        <div class="box-editor">
                            <textarea name="isi_berita" id="editor" style="display: none;"></textarea>
                        </div>

                    </div>
                    <!--End Text Editor-->

                    <!--Bagian sebelah kanan-->
                    <div class="col-lg-3 sidebar">
                        <div class="d-flex justify-content-between my-3">
                            <!--Tombol Simpan sebagai Draft-->
                            <button type="submit" class="btn btn-draft" name="saveAsDraft">
                                <i class='bx bx-save'></i>&nbsp; Draft
                            </button>
                            <!--Tombol Publikasikan-->
                            <button type="submit" class="btn btn-publish">
                                <i class='bx bx-send'></i>&nbsp; Publikasikan
                            </button>
                        </div>

                       <div class="form-group my-2">
                            <label for="formFile" class="form-label ">Upload Thumbnail</label>
                            <div class="input-group">
                                <input type="file" class="form-control rounded-pill" name="gambar_berita" id="formFile" style="padding: .375rem .75rem;" onchange="loadFile(event)">
                            </div>
                            <img id="output" class="my-2" width="200" /> <!-- This will hold the image preview -->
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
                            <label for="kategori" >Pilih kategori</label>
                            <select id="kategori" name="kategori_berita" class="form-control" aria-label="Default select example">
                                <option selected>Pilih kategori</option>
                                
                                @foreach($kategori as $item)
                                    <option style="font-size: 14px"  value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--Youtube Link-->
                        <div class="form-group my-2">
                            <label for="youtube_link">Link YouTube</label>
                            <input id="youtube_link" style="font-size: 14px" type="text" name="youtube_link" placeholder="Masukkan Link YouTube" class="form-control">
                        </div>

                        <!--Meta Deskripsi-->
                        <div class="form-group my-2">
                            <label for="deskripsi">Deskripsi Berita</label>
                            <textarea id="deskripsi" style="font-size: 14px"  name="deskripsi_berita" placeholder="Masukkan deskripsi berita..." class="form-control" required></textarea>                        
                        </div>

                        <!--Meta Keyword-->
                        <div class="form-group my-2">
                            <label for="deskripsi" class="mb-1">Keyword Berita <i class="bx bx-question-mark bx-border-circle" data-toggle="tooltip" data-placement="top" title="Keyword yang baik memiliki maksimal 4 kata kunci"></i></label>
                            <input id="keyword" style="font-size: 14px" type="text" name="keyword_berita" placeholder="Keyword (pisahkan dengan tanda koma)" class="form-control" required>
                        </div>
                        <!--Pengaturan URL-->
                        <div class="form-group my-2">
                            <label for="autoUrl">Pengaturan URL</label>
                            <!--URL Otomatis dari Judul-->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="slug" id="autoUrl" value="auto" checked>
                                <label class="form-check-label" for="autoUrl">
                                    URL Otomatis
                                </label>
                            </div>
                            <!--URL Custom-->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="slug" id="customUrl" value="custom">
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
<script>
    // This script loads the file into the img element once it's selected
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
    <!--Script Pengaturan URL Otomatis-->
    <script src="/js/seo-title.js"></script>
</body>
</html>
