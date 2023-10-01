@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3" >
            <div class="col-md-4 my-2">
                <div class="card p-2">
                    <div class="d-flex align-items-center card-header">
                        <i class=" bx bx-show view-icon bx-sm p-2 ttayang" ></i>
                        &nbsp;
                        <p class="p-0 m-0" style="font-weight: 500">
                            Total penayangan  
                        </p>
                    </div>
                    <div class="card-body">
                        <h2>{{$totalVisitors}}</h2>
                        <div class="d-flex align-items-center mb-0 pb-0">
                            
                            <p class="p-0 m-0">Total seluruh penayangan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-2">
                <div class="card p-2">
                    <div class="d-flex align-items-center card-header">
                        <i class=" bx bx-bar-chart bx-sm p-2 view-icon tayang"></i>

                        &nbsp;
                        <p class="p-0 m-0" style="font-weight: 500">
                            Penayangan hari ini
                        </p>
                    </div>
                    <div class="card-body">
                        <h2>{{$viewsToday}}</h2>
                        <div class="d-flex align-items-center mb-0 pb-0">
                            <p class="p-0 m-0" style="{{ $changePercent >= 0 ? 'color: #489972; background-color: #eafdf1;' : 'color: #c04f4b; background-color: #fef3f2;' }}">
                                <b class="p-2">{{ $changePercent >= 0 ? '+' : '' }}{{ number_format($changePercent, 2) }}%</b>
                            </p>
                            &nbsp;
                            <p class="p-0 m-0">Lebih besar dari kemarin</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 my-2">
                <div class="card p-2">
                    <div class="d-flex align-items-center card-header">
                        <i class=' p-2 bx bx-money bx-sm uang'></i>
                        &nbsp;
                        <p class="p-0 m-0" style="font-weight: 500">
                            Pemasukan bulan ini
                        </p>
                    </div>
                    <div class="card-body">
                        <h2>Rp {{ number_format($monthlyIncome['currentMonth'], 0, ',', '.') }}</h2>
                        <div class="d-flex align-items-center mb-0 pb-0">
                            <p class="p-0 m-0" style="color: #489972; background-color: #eafdf1;">
                                <b class="p-2">{{ sprintf('%+.1f', $monthlyIncome['changePercent']) }}%</b>
                            </p>

                            &nbsp;
                            <p class="p-0 m-0">Lebih besar dari bulan lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card p-2" id="chart-container">
                    <div class="card-header" style="font-size: 18px; ">
                        <div class="d-flex row align-items-center">
                            <div class="col-md-10 titile">
                                <h4>Penayangan Berita</h4>
                                <p style="font-size: 12px;" id="chart-description">Data penayangan berita untuk 7 hari terakhir</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" ></canvas>
                    </div>
                </div>
                <div class="card  my-4 p-2 table-responsive">
                    <div class="card-header" style="font-size: 18px; ">
                        <div class="d-flex row align-items-center">
                            <div class="col-md-10 titile">
                                <h4>Penayangan 7 Berita Teratas</h4>
                                <p style="font-size: 12px;" id="chart-description">Data 7 berita dengan penayangan terbanyak</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="bg" scope="col">Judul</th>
                                    <th class="bg" scope="col" style="text-align: center">Views</th>
                                    <th class="bg" scope="col">Authors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->judul_berita}}</td>
                                    <td style="text-align: center">{{$post->views_count}}</td>
                                    <td>{{$post->author->name ?? 'tidak ada data'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card  p-2">
                    <div class="card-header" style="font-size: 18px; ">
                        <div class="d-flex row align-items-center">
                            <div class="col-md-10 titile">
                                <h4>Pendapatan bulan lalu</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Rp {{ number_format($monthlyIncome['previousMonth'], 0, ',', '.') ?? 'tidak ada data' }}</p>
                    </div>
                </div>
                <div class="card mt-4 p-2">
                    <div class="card-header" style="font-size: 18px; ">
                        <div class="d-flex row align-items-center">
                            <div class="col-md-10 titile">
                                <h4>Author teratas</h4>
                                <p style="font-size: 12px;" id="chart-description">Author dengan berita terbanyak</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Author</th>
                                    <th scope="col" style="text-align: center">Postingan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($authors as $author)
                                <tr> 
                                    <td style=" vertical-align: middle;"><img src="/images/klee.png" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;"></td>
                                    <td style=" vertical-align: middle;" class="align-items-center">{{ $author->name ?? 'tidak ada data'}}</td>
                                    <td style="text-align:center; vertical-align: middle;">{{ $author->berita_count }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="card mt-4 p-2">
                    <div class="card-header" style="font-size: 18px; ">
                        <div class="d-flex row align-items-center">
                            <div class="col-md-10 titile">
                                <h4>Kategori Berita</h4>
                                <p style="font-size: 12px;" id="chart-description">Data jumla berita setiap kategori</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donat"></canvas>
                    </div>
                </div>
                <div class="card mt-4 p-2">
                    <div class="card-header" style="font-size: 18px; ">
                        Top 5 Kategori
                    </div>
                    <div class="card-body table-responsive">
                        <canvas id="myPolarChart"></canvas>

                    </div>

                </div>
                
                
            </div>
        </div>
        
    </div>
@endsection

@section('script')
    <script>
        var ctx1 = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: 'Penayangan Berita',
                    data: <?php echo json_encode($counts); ?>,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        $('#period-selector').change(function() {
            var period = $(this).val();
            $.get("/admin/statistik/data/" + period, function(data) {
                var newDates = data.dates;
                var newCounts = data.counts;
                myChart.data.labels = newDates;
                myChart.data.datasets[0].data = newCounts;
                myChart.update();
            
            $('#chart-description').text("Data penayangan berita untuk 7 hari terakhir");
            });
        });


    </script>
    <script>

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var backgroundColors = {!! json_encode($kategoriLabels) !!}.map(function() {
        return getRandomColor();
    });

    // Menghasilkan array warna border untuk setiap kategori
    var borderColors = backgroundColors.map(function(color) {
        return color;
    });

    var ctx2 = document.getElementById('donat').getContext('2d');
    var donat = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($kategoriLabels) !!},
            datasets: [{
                data: {!! json_encode($beritaCounts) !!},
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
        }
    });
    </script>
    <script>
    let categories = @json($categories);

    let ctx = document.getElementById('myPolarChart').getContext('2d');

    new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: categories.categories_names,
            datasets: [{
                data: categories.view_counts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)'
                ]
            }]
        }
    });

    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection