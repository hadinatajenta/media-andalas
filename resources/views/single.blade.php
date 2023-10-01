<!DOCTYPE html>
<html lang="en">

<head>
    {!! SEO::generate() !!}

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset($website->favicon) }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/css/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">
</head>


<body>
    <!-- Topbar Start -->
    <x-topbar/>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <x-navbar/>
    <!-- Navbar End -->
<div class="container-fluid mt-5 mb-3 pt-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="section-title border-right-0 mb-0" style="width: 180px;">
                            <h4 class="m-0 text-uppercase font-weight-bold">Tranding</h4>
                        </div>
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center bg-white border border-left-0"
                            style="width: calc(100% - 180px); padding-right: 100px;">
                            <div class="text-truncate"><a class="text-secondary text-uppercase font-weight-semi-bold" href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante tincidunt, sed faucibus nisl sodales</a></div>
                            <div class="text-truncate"><a class="text-secondary text-uppercase font-weight-semi-bold" href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante tincidunt, sed faucibus nisl sodales</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                      <!-- Jika gambar dan link YouTube ada, tampilkan <iframe> saja -->
                        @if(!empty($berita->gambar_berita) && !empty($berita->youtube_link))
                            <iframe class="img-fluid w-100 " src="https://www.youtube.com/embed/{{basename(parse_url($berita->youtube_link, PHP_URL_PATH))}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="height: 500px"></iframe>
                        <!-- Jika hanya gambar yang ada, tampilkan <img> -->
                        @elseif(!empty($berita->gambar_berita) && empty($berita->youtube_link))
                            <img class="img-fluid w-100" src="/images/{{$berita->gambar_berita}}" style="object-fit: cover;">

                        <!-- Jika hanya link YouTube yang ada, tampilkan <iframe> -->
                        @elseif(empty($berita->gambar_berita) && !empty($berita->youtube_link))
                            <iframe class="img-fluid w-100" src="https://www.youtube.com/embed/{{basename(parse_url($berita->youtube_link, PHP_URL_PATH))}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="height: 500px"></iframe>
                        @endif

                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                <!--nama Kategori-->
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="">{{$berita->kategori->nama_kategori}}</a>
                                
                                @php
                                    \Carbon\Carbon::setLocale('id');
                                @endphp
                                <!--tanggal-->
                                <a class="text-body" href="">{{$berita->updated_at->translatedFormat('d F Y')}}</a>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{{$berita->judul_berita}}</h1>
                            <!--Isi berita-->
                            <p >
                                {!! $berita->isi_berita !!}
                            </p>
                            
                        </div>
                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle mr-2" src="/images/user.jpg" width="25" height="25" alt="">
                                <span>John Doe</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <button class="btn" onclick="shareToWhatsApp()"><i class='bx bxl-whatsapp bx-sm'></i></button>
                                <button class="btn" onclick="shareToFacebook()"><i class='bx bxl-facebook bx-sm'></i></button>
                                <button class="btn" onclick="shareToTwitter()"><i class='bx bxl-twitter bx-sm'></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->
                </div>

                <!--Sidebar-->
                <x-sidebar/>
                <!--end Sidebar-->
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->

    <!-- Footer Start -->
    <x-footer/>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/css/lib/easing/easing.min.js"></script>
    <script src="/css/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/js/main.js"></script>
  <script>
function shareToWhatsApp() {
  var postUrl = encodeURI(document.location.origin + "/berita/" + "{{ $berita->slug }}");
  var whatsappUrl = "https://api.whatsapp.com/send?text=" + postUrl;
  window.open(whatsappUrl, '_blank');
}

function shareToFacebook() {
  var postUrl = encodeURI(document.location.origin + "/berita/" + "{{ $berita->slug }}");
  var facebookUrl = "https://www.facebook.com/sharer.php?u=" + postUrl;
  window.open(facebookUrl, '_blank');
}

function shareToTwitter() {
  var postUrl = encodeURI(document.location.origin + "/berita/" + "{{ $berita->slug }}");
  var postTitle = encodeURI("{{ $berita->judul_berita }}"); // replace with your post title
  var twitterUrl = "https://twitter.com/share?url=" + postUrl + "&text=" + postTitle;
  window.open(twitterUrl, '_blank');
}
</script>

</body>

</html>