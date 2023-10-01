<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title','Sidebar')</title>
    <!-- CSS -->
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/notification.css">
    <link rel="stylesheet" href="/css/kategori.css">
    <link rel="stylesheet" href="/css/statistik.css">
    <link rel="stylesheet" href="/css/iklan.css">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <!--Chart JS-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--Bootstrap JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <nav class="nav">
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <span class="logo-name">Andalas</span>
            </div>
            <div class="sidebar">
                <div class="logo">
                    <i class="bx bx-menu menu-icon"></i>
                    <span class="logo-name">Andalas</span>
                </div>

                <div class="sidebar-content">
                    <ul class="lists">
                        <li class="list">
                            <a href="/admin/dashboard" class="nav-link">
                                <i class="bx bx-home-alt icon"></i>
                                <span class="link">Dashboard</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="/admin/kategori" class="nav-link">
                                <i class="bx bx-bar-chart-alt-2 icon"></i>
                                <span class="link">Kategori</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="/admin/statistik" class="nav-link">
                                <i class="bx bx-pie-chart-alt-2 icon"></i>
                                <span class="link">Statistik</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="/admin/management-iklan/iklan" class="nav-link">
                                <i class="bx bx-message-rounded icon"></i>
                                <span class="link">Iklan</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="/admin/manajemen-author" class="nav-link">
                                <i class="bx bx-pie-chart-alt-2 icon"></i>
                                <span class="link">Author</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="/admin/pengaturan/profile" class="nav-link">
                                <i class="bx bx-user icon"></i>
                                <span class="link">Profile</span>
                            </a>
                        </li>
                    </ul>

                    <div class="bottom-cotent">
                        <li class="list">
                            <a href="{{ route('admin.pengaturan-website.index') }}" class="nav-link">
                                <i class="bx bx-cog icon"></i>
                                <span class="link">Settings</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="bx bx-log-out icon"></i>
                                <span class="link">Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        
                    </div>
                </div>
            </div>
        </nav>
        <section class="overlay"></section>
        
        <main>
            @yield('content')
        </main>
    </div>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="/js/script.js"></script>
    @yield('script')
</body>
</html>
