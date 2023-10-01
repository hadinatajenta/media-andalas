<!DOCTYPE html>
<html lang="id-ID" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    {!! SEO::generate() !!}
        <link rel="icon" type="image/x-icon" href="{{ asset($website->favicon) }}">


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2X714VSNX2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-2X714VSNX2');
    </script>
    <!-- Favicon -->
    <link href="/images/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/css/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

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

    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 px-0">
                <!-- Main Carousel Start -->
                <div class="owl-carousel main-carousel position-relative">
                    @foreach($berita as $item)
                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="{{ asset("storage/berita/$item->gambar_berita") }}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="">{{$item->kategori->nama_kategori}}</a>
                                <a class="text-white" href="">{{$item->updated_at->translatedFormat('d F Y')}}</a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="href="{{ route('single.show', $item->slug) }}"">{{$item->judul_berita}}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Main Carousel End -->
            </div>
            <div class="col-lg-5 px-0">
                <!-- Sub Carousel Start -->
                <div class="row mx-0">
                    @foreach ($mostViewedBerita as $item)
                    <div class="col-md-6 px-0">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="{{ asset("storage/berita/{$item->berita->gambar_berita}") }}" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="">{{$item->berita->kategori->nama_kategori}}</a>
                                    <a class="text-white" href=""><small>{{$item->berita->updated_at->translatedFormat('d F Y')}}</small></a>
                                </div>
                                <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="">{{$item->berita->judul_berita}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Sub Carousel End -->
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->


    <!-- Breaking News Start -->
    <div class="container-fluid bg-dark py-3 mb-3">
        <div class="container">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">Breaking News</div>
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                            style="width: calc(100% - 170px); padding-right: 90px;">
                            <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante tincidunt, sed faucibus nisl sodales</a></div>
                            <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante tincidunt, sed faucibus nisl sodales</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->

    <!-- Featured News Slider Start -->
    <div class="container-fluid pt-5 mb-3">
        <div class="container">
            <div class="section-title">
                <h4 class="m-0 text-uppercase font-weight-bold">Featured News</h4>
            </div>
            <div class="owl-carousel news-carousel carousel-item-4 position-relative">
                @foreach ($berita as $item)
                <div class="position-relative overflow-hidden" style="height: 300px;">
                    <img class="img-fluid h-100"  alt="{{$item->judul_berita}}"
                        @if ($item->gambar_berita)
                            src="{{ Storage::url('berita/' . $item->gambar_berita) }}"
                        @else
                            src="{{ Storage::url('berita/tidak-ada-gambar.jpg') }}"
                        @endif style="object-fit: cover;"
                    >
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                href="">{{$item->kategori->nama_kategori ?? 'Tidak ada Kategori'}} </a>
                             @php
                                \Carbon\Carbon::setLocale('id');
                            @endphp
                            <a class="text-white" href=""><small>{{$item->updated_at->translatedFormat('d F Y')}}</small></a>
                        </div>
                        <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="{{ route('single.show', $item->slug) }}">{{$item->judul_berita}}</a>
                    </div>
                </div> 
                @endforeach
                
            </div>
        </div>
    </div>
    <!-- Featured News Slider End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                            </div>
                        </div>                            
                        @php
                            $breakAt = 4; 
                            $secondCardCount = 0; // to hold the count of second style cards
                            $secondCardLimit = 4;
                            $thirdCardCount = 0; // to hold the count of third style cards
                            $thirdCardLimit = 1; // display only one large card
                            $smallCardCount = 0; // to hold the count of small style cards
                            $smallCardLimit = 4; // display four small cards
                        @endphp
                         <!--Iklan 728x90-->
                        <div class="col-lg-12 mb-3">
                            @if($iklan)
                                <a href="{{$iklan->website}}"><img class="img-fluid w-100" src="/uploads/{{ $iklan->gambar_iklan }}" alt="{{$iklan->website}}"></a>
                            @else
                                <p>No Ads Available</p>
                            @endif
                        </div>
                        <!--End Iklan-->
                        @foreach($latestnews as $index => $item)
                            @if($index < $breakAt)
                                <!--2 Card Besar-->
                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <!--Gambar berita-->
                                        <img class="img-fluid w-100" alt="{{$item->judul_berita}}"
                                        @if ($item->gambar_berita)
                                            src="{{ Storage::url('berita/' . $item->gambar_berita) }}"
                                        @else
                                            src="{{ Storage::url('berita/tidak-ada-gambar.jpg') }}"
                                        @endif
                                        style="width: 364px; height: 226px; object-fit: cover;" >

                                        <!-- Grup info berita -->
                                        <div class="bg-white border border-top-0 p-4">
                                            <div class="mb-2">
                                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="">{{$item->kategori->nama_kategori}}</a>
                                                <a class="text-body" href=""><small>{{$item->created_at->format ('j F Y')}}</small></a>
                                            </div>
                                            <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="/single/{{$item->slug}}">{{Str::limit($item->judul_berita, 31, '...')}}</a>
                                            <p class="m-0">{{Str::limit($item->deskripsi_berita,96,'...')}}</p>
                                        </div>
                                        <!--Grup info author-->
                                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                            <!-- nama author-->
                                            <div class="d-flex align-items-center">
                                                <small>Penulis : {{$item->author? $item->author->name : 'Tidak ada nama' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            @elseif($secondCardCount < $secondCardLimit)
                                <!--4 Card Kecil-->
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                                        <img alt="{{$item->judul_berita}}" class="img-fluid"  style="height:110px; width: 110px; object-fit: cover;"
                                            @if ($item->gambar_berita)
                                                src="{{ Storage::url('berita/' . $item->gambar_berita) }}"
                                            @else
                                                src="{{ Storage::url('berita/tidak-ada-gambar.jpg') }}"
                                            @endif
                                        alt="{{$item->judul_berita}}">
                                        <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                            <div class="mb-2">
                                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">{{$item->kategori->nama_kategori}}</a>
                                                <a class="text-body" href=""><small>{{ $item->created_at->format('j F Y') }}</small></a>
                                            </div>
                                            <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="/single/{{$item->slug}}">{{Str::limit ($item->judul_berita,50,'...')}}</a>
                                        </div>
                                    </div>                                   
                                </div>
                                @php
                                    $secondCardCount++;
                                @endphp
                            
                            @else
                                @if($thirdCardCount < $thirdCardLimit)
                                    <div class="col-lg-12">
                                        <div class="row news-lg mx-0 mb-3">
                                            <div class="col-md-6 h-100 px-0">
                                                <img alt="{{$item->judul_berita}}" class="img-fluid h-100" alt="{{$item->judul_berita}}"
                                                @if ($item->gambar_berita)
                                                    src="{{ Storage::url('berita/' . $item->gambar_berita) }}"
                                                @else
                                                    src="{{ Storage::url('berita/tidak-ada-gambar.jpg') }}"
                                                @endif
                                                style="width: 372px; height:350px; object-fit: cover;">
                                            </div>
                                            <div class="col-md-6 d-flex flex-column border bg-white h-100 px-0">
                                                <div class="mt-auto p-4">
                                                    <div class="mb-2">
                                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                                            href="">{{ $item->kategori ? $item->kategori->nama_kategori : 'null' }}</a>
                                                        <a class="text-body" href="">{{ $item->created_at->format('j F Y') }}</small></a>
                                                    </div>
                                                    <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="">{{ Str::limit($item->judul_berita, 50, '...') }}</a>
                                                    <p class="m-0">{{ Str::limit($item->konten_berita, 150, '...') }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between bg-white border-top mt-auto p-4">
                                                    <div class="d-flex align-items-center">
                                                         <small>{{ $item->author? $item->author->name : 'Tidak ada nama'  }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $thirdCardCount++;
                                    @endphp
                                @elseif($smallCardCount < $smallCardLimit)
                                    <div class="col-lg-6">
                                        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                                            <img alt="{{$item->judul_berita}}" class="img-fluid"  style="height:110px; width: 110px; object-fit: cover;"
                                                @if ($item->gambar_berita)
                                                    src="{{ Storage::url('berita/' . $item->gambar_berita) }}"
                                                @else
                                                    src="{{ Storage::url('berita/tidak-ada-gambar.jpg') }}"
                                                @endif
                                            alt="{{$item->judul_berita}}">
                                            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                                <div class="mb-2">
                                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">{{$item->kategori->nama_kategori}}</a>
                                                    <a class="text-body" href=""><small>{{ $item->created_at->format('j F Y') }}</small></a>
                                                </div>
                                                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="/single/{{$item->slug}}">{{Str::limit ($item->judul_berita,50,'...')}}</a>
                                            </div>
                                        </div>                                   
                                    </div>
                                    @php
                                        $smallCardCount++;
                                    @endphp
                                @endif
                            @endif
                        @endforeach                   
                    </div>
                </div>
                <!--Sidebar-->       
                <x-sidebar/>
                <!--End sidebar-->
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->


    <x-footer/>



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/css/lib/easing/easing.min.js"></script>
    <script src="/css/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/js/main.js"></script>
    
</body>

</html>