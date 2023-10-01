<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
      {!! SEO::generate() !!}
        <link rel="icon" type="image/x-icon" href="{{ asset($website->favicon) }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <x-topbar/>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <x-navbar/>
    <!-- Navbar End -->

    <!-- Contact Start -->
    <div class="container-fluid mt-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Redaksi</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-4 mb-3">
                        <div class="mb-4">
                            <h6 class="text-uppercase font-weight-bold">Direktur Konten</h6>
                            <p class="mb-4">Hartoni S.H</p>

                            <h6 class="text-uppercase font-weight-bold">Dewan Redaksi</h6>
                            <p class="mb-4">Hendri Suadi, Fajri Yanto, Ardiyansyah</p>

                            <h6 class="text-uppercase font-weight-bold">Pemimpin Redaksi/Penanggung Jawab</h6>
                            <p class="mb-4">Dani Setiawan</p>

                            <h6 class="text-uppercase font-weight-bold">Wakil Pemimpin Redaksi</h6>
                            <p class="mb-4">Hadinata Jenta</p>

                            <h6 class="text-uppercase font-weight-bold">Komite Etik</h6>
                            <p class="mb-4">Mulyasari, Fatmawati, Desmita</p>

                            <h6 class="text-uppercase font-weight-bold">Content Creator Media Social</h6>
                            <p class="mb-4">Adam (Redaktur Pelaksana), Dewi JJ, Tia, Wulan</p>

                            <h6 class="text-uppercase font-weight-bold">Sekretaris Redaksi</h6>
                            <p class="mb-4">Ferfti Margaret (Head), Peren, Febrina</p>

                            <h6 class="text-uppercase font-weight-bold">ANDALASNETCOM</h6>
                            <p class="mb-4">Mat Lukman (Jakarta), Eren (Bandar Lampung) Zuli Ag (Tubaba), Abdul Razak (Lampung Tengah), Dewi JJ (Lampung Barat) Angga (Lampung Utara), Gentur Sumedi (Tulang Bawang) Andiwijaya (Palembang)</p>

                            <h6 class="text-uppercase font-weight-bold">PT ANDALAS MEDIA GROUP</h6>
                            <p class="mb-4">{{$website->alamat}}</p>
                            <p class="mb-4">Email : {{$website->email}}</p>
                            <p class="mb-4">Telp: {{$website->no_telp}} (Hunting)</p>

                            <h6 class="text-uppercase font-weight-bold">Kontak Iklan</h6>
                            <p class="mb-4">Telp: 0852 6640 6365</p>
                            <p class="mb-4">Email: andalasnet88@gmail.com</p>
                            
                        </div>                     
                    </div>


                </div>
                <x-sidebar/>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Footer Start -->
    <x-footer/>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>