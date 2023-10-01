<!DOCTYPE html>
<html lang="en">

<head>
    {!! SEO::generate() !!}

    <!-- Favicon -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
                                    href=""></a>
                                
                                @php
                                    \Carbon\Carbon::setLocale('id');
                                @endphp
                                <!--tanggal-->
                                <a class="text-body" href=""></a>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold"></h1>
                            <!--Isi berita-->
                            <h1>Disclaimer</h1>
                            <p>Last updated: August 01, 2023</p>
                            <h1>Interpretation and Definitions</h1>
                            <h2>Interpretation</h2>
                            <p>The words of which the initial letter is capitalized have meanings defined under the following conditions.
                            The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
                            <h2>Definitions</h2>
                            <p>For the purposes of this Disclaimer:</p>
                            <ul>
                            <li><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Disclaimer) refers to ANDALASNET.</li>
                            <li><strong>Service</strong> refers to the Website.</li>
                            <li><strong>You</strong> means the individual accessing the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</li>
                            <li><strong>Website</strong> refers to ANDALASNET, accessible from <a href="https://andalasnet.com/" rel="external nofollow noopener" target="_blank">https://andalasnet.com/</a></li>
                            </ul>
                            <h1>Disclaimer</h1>
                            <p>The information contained on the Service is for general information purposes only.</p>
                            <p>The Company assumes no responsibility for errors or omissions in the contents of the Service.</p>
                            <p>In no event shall the Company be liable for any special, direct, indirect, consequential, or incidental damages or any damages whatsoever, whether in an action of contract, negligence or other tort, arising out of or in connection with the use of the Service or the contents of the Service. The Company reserves the right to make additions, deletions, or modifications to the contents on the Service at any time without prior notice. This Disclaimer has been created with the help of the <a href="https://www.termsfeed.com/disclaimer-generator/" target="_blank">Disclaimer Generator</a>.</p>
                            <p>The Company does not warrant that the Service is free of viruses or other harmful components.</p>
                            <h1>External Links Disclaimer</h1>
                            <p>The Service may contain links to external websites that are not provided or maintained by or in any way affiliated with the Company.</p>
                            <p>Please note that the Company does not guarantee the accuracy, relevance, timeliness, or completeness of any information on these external websites.</p>
                            <h1>Errors and Omissions Disclaimer</h1>
                            <p>The information given by the Service is for general guidance on matters of interest only. Even if the Company takes every precaution to ensure that the content of the Service is both current and accurate, errors can occur. Plus, given the changing nature of laws, rules and regulations, there may be delays, omissions or inaccuracies in the information contained on the Service.</p>
                            <p>The Company is not responsible for any errors or omissions, or for the results obtained from the use of this information.</p>
                            <h1>Fair Use Disclaimer</h1>
                            <p>The Company may use copyrighted material which has not always been specifically authorized by the copyright owner. The Company is making such material available for criticism, comment, news reporting, teaching, scholarship, or research.</p>
                            <p>The Company believes this constitutes a &quot;fair use&quot; of any such copyrighted material as provided for in section 107 of the United States Copyright law.</p>
                            <p>If You wish to use copyrighted material from the Service for your own purposes that go beyond fair use, You must obtain permission from the copyright owner.</p>
                            <h1>Views Expressed Disclaimer</h1>
                            <p>The Service may contain views and opinions which are those of the authors and do not necessarily reflect the official policy or position of any other author, agency, organization, employer or company, including the Company.</p>
                            <p>Comments published by users are their sole responsibility and the users will take full responsibility, liability and blame for any libel or litigation that results from something written in or as a direct result of something written in a comment. The Company is not liable for any comment published by users and reserves the right to delete any comment for any reason whatsoever.</p>
                            <h1>No Responsibility Disclaimer</h1>
                            <p>The information on the Service is provided with the understanding that the Company is not herein engaged in rendering legal, accounting, tax, or other professional advice and services. As such, it should not be used as a substitute for consultation with professional accounting, tax, legal or other competent advisers.</p>
                            <p>In no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever arising out of or in connection with your access or use or inability to access or use the Service.</p>
                            <h1>&quot;Use at Your Own Risk&quot; Disclaimer</h1>
                            <p>All information in the Service is provided &quot;as is&quot;, with no guarantee of completeness, accuracy, timeliness or of the results obtained from the use of this information, and without warranty of any kind, express or implied, including, but not limited to warranties of performance, merchantability and fitness for a particular purpose.</p>
                            <p>The Company will not be liable to You or anyone else for any decision made or action taken in reliance on the information given by the Service or for any consequential, special or similar damages, even if advised of the possibility of such damages.</p>
                            <h1>Contact Us</h1>
                            <p>If you have any questions about this Disclaimer, You can contact Us:</p>
                            <ul>
                            <li>By email: pt.andalasmediagroup@gmail.com</li>
                            </ul>
                            
                        </div>
                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle mr-2" src="/images/user.jpg" width="25" height="25" alt="">
                                <span>John Doe</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn btn-facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;"> Share on Facebook </a>

                                <a href="whatsapp://send?text={{ urlencode('Ini judul berita: '.Request::url()) }}" data-action="share/whatsapp/share">Share on WhatsApp</a>
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
</body>

</html>