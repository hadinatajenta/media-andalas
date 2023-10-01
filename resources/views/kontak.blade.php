<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Favicon -->
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
                        <h4 class="m-0 text-uppercase font-weight-bold">Contact Us For Any Queries</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-4 mb-3">
                        <div class="mb-4">
                            <h6 class="text-uppercase font-weight-bold">Kontak Kami</h6>
                            <p class="mb-4">Kami di ANDALASNET menyambut dengan tangan terbuka untuk menjalin hubungan dengan Anda. Kontak kami adalah jalan pintas untuk menghubungi tim kami yang berdedikasi, yang selalu siap membantu dan menjawab pertanyaan Anda seputar layanan kami.
                                Kami mengutamakan komunikasi yang transparan dan responsif, dan tim kami terlatih untuk memberikan pelayanan terbaik bagi Anda. Jangan ragu untuk menghubungi kami untuk berbagai hal, mulai dari bantuan teknis, informasi produk, hingga peluang kerjasama.
                                Kami percaya bahwa kerjasama dan kolaborasi adalah kunci keberhasilan, dan kami berharap dapat menjalin kemitraan yang kuat dengan Anda. Hubungi kami melalui kontak yang telah disediakan di bawah ini:</p>
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fa fa-map-marker-alt text-primary mr-2"></i>
                                    <h6 class="font-weight-bold mb-0">Kantor Kami</h6>
                                </div>
                                <p class="m-0">{{$website->alamat}} .Buka di GoogleMaps</p>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fa fa-envelope-open text-primary mr-2"></i>
                                    <h6 class="font-weight-bold mb-0">Email Kami</h6>
                                </div>
                                <p class="m-0">{{$website->email}}</p>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fa fa-phone-alt text-primary mr-2"></i>
                                    <h6 class="font-weight-bold mb-0">Hubungi Kami</h6>
                                </div>
                                <p class="m-0">{{$website->no_telp}}</p>
                            </div>
                            <p>Tim kami siap menjawab setiap pertanyaan, masukan, dan masalah yang mungkin Anda hadapi. Kami berkomitmen untuk memberikan layanan yang unggul dan solusi yang tepat guna untuk memenuhi kebutuhan Anda.

Terima kasih atas kunjungan Anda di ANDALASNET. Kami berharap dapat berkomunikasi dengan Anda segera!</p>
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