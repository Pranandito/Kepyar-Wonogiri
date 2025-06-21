<style>
    .cid-u4ayil8qZ2 {
        z-index: 0;
        width: 100%;
        position: relative;
    }
    
    .custom-footer {
        position: relative;
        bottom: 50px; /* Adjust this value to move the footer higher */
        margin-bottom: 0; /* Ensure there's no additional margin below the footer */
    }

    #container-pompa {
        padding-top: 120px;
        margin-top: 20px;
    }

    .navbar {
        opacity: 0.75;
    }

    .card {
        margin: 5px;
        opacity: 0.82; 
        background-color: rgba(255, 255, 255, 0.75); /* add a semi-transparent background */
    }
    
    .card-text {
        color: rgba(0, 0, 0, 1); /* change the color to black with 100% opacity */
    }

    .card-text {
        font-size: 20px;
        margin: 15px 0px;
    }

    .card-text-secondary {
        font-size: 16px;
        margin: 15px 0px 0px 0px;
    }

    .card-group {
        flex-wrap: nowrap;
    }

    .card-group .card {
        flex: 1;
        margin: 10px;
        width: calc(50% - 20px); /* adjust the width to fit two cards in a row */
    }

    .card-group .card:first-child {
        margin-left: 0;
    }

    .card-group .card:last-child {
        margin-right: 0;
    }

    #dayaHarianChart {
        width: 600px;
        height: 600px;
    }

    .map iframe {
        width: 300px;
        height: 400px;
    }

    .row {
        margin-bottom: 20px; /* Add some margin between rows */
    }
    
    #body{
        min-height: 100vh; /* add this line */
        background-image: url("storage/assets/images/kacang (3).JPG");
        background-size: cover;
        overflow:hidden;
        display:flex;
    }
    
    .container-body {
        /* display:flex; */
        justify-content: center;
        padding: 30px;
        margin: 20px auto; /* changed to make it centered */
        /* height: 80%; */
        width: 100%;
    }

    .dropdown-item.active {
        background-color: yellow;
        color: black; /* Optional: adjust text color if needed */
    }

    @media (min-width: 600px) { /* adjust the breakpoint as needed */
    .card-group {
        display:flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 10px;
    }
    .card-group .card {
        width: calc(33.33% - 20px); /* adjust the width to fit 3 cards in a row */
        margin: 10px;
    }

    .icon{
        font-size: 20px;
        margin-right: 10px;
    }

    .icon-history{
        font-size: 25px;
        margin-right: 10px;
        padding: 10px;
        background-color: #f4632c;
        color: white;
        border-radius: 50%;
    }

    .tanggal{
        font-size: 20px;
        margin-right: 10px;
        height: 50px;
        width: 50px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ffa404;
        color: white;
        border-radius: 50%;
    }

    .tanggal.orange { background-color: #ffa404; }
    .tanggal.blue   { background-color: #2293f9; }
    .tanggal.green    { background-color: #3baa73; }
    .tanggal.purple { background-color: #8c52ff; }
    }
</style>

@extends('landingpage.layouts.main')

@section('content')
<div id="body">
    <div id="container-pompa" class="container-body">
        <div class="d-flex flex-column align-items-center justify-content-center h-70">
            <!-- Card Group 1: Power and Profit Stats -->
            <div class="col-12">
                <div class="card-group">
                    <!-- Card Air Pompa -->
                    <div class="card shadow-sm p-4 bg-white rounded">
                        <div class="card-body" style="padding: 0;">
                            <div class="d-flex flex-row justify-content-between align-items-center py-2 px-4">
                            <div class="d-flex flex-row align-items-center">
                                    <i class="bi bi-droplet icon-history"></i>                          
                                    <div class="ms-3">
                                        <h5 style="font-size: 18px;" class="card-title text-dark mb-0">
                                            Volume Air <br> Yang Dipompa
                                        </h5>
                                    </div>
                                </div>
                                <h5 class="fs-5 mb-0 text-dark"> <span id="volume" class="fs-2">0</span>&nbsp;&nbsp;&nbsp;Liter</h5>
                            </div>
                            <hr>
                            <h2 class="card-text-secondary" style="display: flex; justify-content: center; text-align: center; gap: 16px;">
                                <span id="debit" style="flex: 1;">0 L/Min</span>
                                <span style="flex: 0; color: #999;">|</span>
                                <span id="kecepatan"style="flex: 1;">0 m/s</span>
                            </h2>
                        </div>
                    </div>
                    <!-- Card Daya DC -->
                    <div class="card shadow-sm p-4 bg-white rounded">
                        <div class="card-body" style="padding: 0;">
                            <div class="d-flex flex-row justify-content-between align-items-center py-2 px-4">
                            <div class="d-flex flex-row align-items-center">
                                    <i class="bi bi-sun icon-history"></i>                          
                                    <div class="ms-3">
                                        <h5 style="font-size: 18px;" class="card-title text-dark mb-0">
                                            Daya Listrik <br> Panel Surya
                                        </h5>
                                    </div>
                                </div>
                                <h5 class="fs-5 mb-0 text-dark"> <span id="daya" class="fs-2">0</span>&nbsp;&nbsp;&nbsp;W</h5>
                            </div>
                            <hr>
                            <h2 class="card-text-secondary" style="display: flex; justify-content: center; text-align: center; gap: 16px;">
                                <span id="tegangan" style="flex: 1;">0 V</span>
                                <span style="flex: 0; color: #999;">|</span>
                                <span id="arus"style="flex: 1;">0 A</span>
                                <span style="flex: 0; color: #999;">|</span>
                                <span id="peak"style="flex: 1;">0 Wp</span>
                            </h2>
                        </div>
                    </div>
                    <!-- Card Penggunaan Energi Listrik -->
                    <div class="card shadow-sm p-4 bg-white rounded">
                        <div class="card-body" style="padding: 0;">
                            <div class="d-flex flex-row justify-content-between align-items-center py-2 px-4">
                                <div class="d-flex flex-row align-items-center">
                                    <i class="bi bi-lightning icon-history"></i>                          
                                    <div class="ms-3">
                                        <h5 style="font-size: 18px;" class="card-title text-dark mb-0">
                                            Penggunaan Energi <br> Listrik Hari Ini
                                        </h5>
                                    </div>
                                </div>
                                <h5 class="fs-5 mb-0 text-dark"> <span id="energi" class="fs-2">0</span>&nbsp;&nbsp;&nbsp;Wh</h5>
                            </div>
                            <hr>
                            <h2 class="card-text-secondary" style="display: flex; justify-content: center; text-align: center; gap: 16px;">
                                <span id="penghematan" style="flex: 1;">Rp 0</span>
                                <span style="flex: 0; color: #999;">|</span>
                                <span id="emisi" style="flex: 1;">0.3 kg CO2</span>
                                <span style="flex: 0; color: #999;">|</span>
                                <span id="durasi" style="flex: 1;">30 menit</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Group 2: Detailed Information and Chart -->
            <div class="col-12">
                <div class="card-group">
                    <div class="card bg-white rounded">
                        <div class="card-body">
                            <i class="bi bi-bar-chart" style="font-size: 24px;">
                                <span> Air Yang Dipompa</span>
                            </i>
                            <canvas id="Volume-Air"></canvas>
                        </div>
                    </div>
                    <div class="card bg-white rounded">
                        <div class="card-body">
                            <i class="bi bi-bar-chart" style="font-size: 24px;">
                                <span> Daya Listrik Yang Dihasilkan</span>
                            </i>
                            <canvas id="Daya-Listrik"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid px-3">
                <div class="row">
                    <div class="col-6 ps-0 pe-1">
                        <div class="card-group">
                            <div class="card shadow-sm bg-white rounded text-muted">
                                <div class="card-body" style="padding: 2rem;">
                                    <div class="d-flex flex-row  align-items-center">
                                        <i class="bi bi-asterisk icon-history"></i>                          
                                        <div class="ms-3">
                                            <h5 style="font-size: 18px;" class="card-title text-dark">
                                                Statistik  Total Penggunaan
                                            </h5>
                                            <h5 class="fs-6 mb-0">20 Januari 2025 - {{ $riwayat['tanggal'] ?? 20}} {{ $riwayat['bulan'] ?? 'Januari'}} {{ $riwayat['tahun'] ?? 2025}}</h5>
                                        </div>
                                    </div>
                                    <h2 class="py-3 mb-0 mt-3 text-center fs-5 text-dark"><span style="font-size: 50px;">{{ $riwayat['volume_total'] ?? 0}}</span>&nbsp;&nbsp;&nbsp;Liter Air</h2>
                                    <hr>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h5 class="card-title fs-6 mb-0">
                                            <i class="bi bi-stopwatch icon"></i>
                                            Durasi Total
                                        </h5>
                                        <h5 class="fs-6 mb-0">{{ $riwayat['jam_total']  ?? 0}} Jam - {{ $riwayat['menit_total']  ?? 0}} Menit</h5>
                                    </div>
                                    <hr>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h5 class="card-title fs-6 mb-0">
                                            <i class="bi bi-lightning icon"></i>
                                            Energi Listrik
                                        </h5>
                                        <h5 class="fs-6 mb-0">{{ $riwayat['energi_total']  ?? 0}} kWh</h5>
                                    </div>
                                    <hr>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h5 class="card-title fs-6 mb-0">
                                            <i class="bi bi-cash icon"></i>
                                            Penghematan
                                        </h5>
                                        <h5 class="fs-6 mb-0">Rp {{ $riwayat['penghematan_total']  ?? 0}}</h5>
                                    </div>
                                    <hr>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h5 class="card-title fs-6 mb-0">
                                            <i class="bi bi-fire icon"></i>
                                            Reduksi Emisi
                                        </h5>
                                        <h5 class="fs-6 mb-0">{{ $riwayat['emisi_total']  ?? 0}} kg CO2</h5>
                                    </div>
                                    <hr>  
                                </div>
                            </div>
                            <div class="card shadow-sm bg-white rounded text-muted">
                                <div class="card-body" style="padding: 2rem;">
                                    <div class="d-flex flex-row  align-items-center">
                                        <i class="bi bi-clock-history icon-history"></i>                          
                                        <div class="ms-3">
                                            <h5 style="font-size: 18px;" class="card-title text-dark">
                                                Riwayat Penggunaan
                                            </h5>
                                            <h5 class="fs-6 mb-0">4 aktivitas terakhir</h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <h5 class="card-title fs-6 mb-0 fw-bold tanggal orange">
                                            {{ $aktivitas[0]['bulan'] ?? 0}}/{{ $aktivitas[0]['tanggal'] ?? 0}}
                                        </h5>
                                        <h5 class="fs-6 mb-0">{{ $aktivitas[0]['volume'] ?? 0}} L&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{ $aktivitas[0]['durasi_harian'] ?? 0}} Menit&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;&nbsp; {{ $aktivitas[0]['energi'] ?? 0}} Wh</h5>
                                    </div>
                                    <hr>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <h5 class="card-title fs-6 mb-0 fw-bold tanggal blue">
                                            {{ $aktivitas[1]['bulan'] ?? 0}}/{{ $aktivitas[1]['tanggal'] ?? 0}}
                                        </h5>
                                        <h5 class="fs-6 mb-0">{{ $aktivitas[1]['volume'] ?? 0}} L&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{ $aktivitas[1]['durasi_harian'] ?? 0}} Menit&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;&nbsp; {{ $aktivitas[0]['energi'] ?? 0}} Wh</h5>
                                    </div>
                                    <hr>  
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <h5 class="card-title fs-6 mb-0 fw-bold tanggal green">
                                            {{ $aktivitas[2]['bulan'] ?? 0}}/{{ $aktivitas[2]['tanggal'] ?? 0}}
                                        </h5>
                                        <h5 class="fs-6 mb-0">{{ $aktivitas[2]['volume'] ?? 0}} L&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{ $aktivitas[2]['durasi_harian'] ?? 0}} Menit&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;&nbsp; {{ $aktivitas[0]['energi'] ?? 0}} Wh</h5>
                                    </div>
                                    <hr>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <h5 class="card-title fs-6 mb-0 fw-bold tanggal purple">
                                            {{ $aktivitas[3]['bulan'] ?? 0}}/{{ $aktivitas[3]['tanggal'] ?? 0}}
                                        </h5>
                                        <h5 class="fs-6 mb-0">{{ $aktivitas[3]['volume'] ?? 0}} L&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{ $aktivitas[3]['durasi_harian'] ?? 0}} Menit&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;&nbsp; {{ $aktivitas[0]['energi'] ?? 0}} Wh</h5>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6  ps-1 pe-0">
                        <div class="card-group">
                            <div class="card bg-white rounded">
                                <div class="card-body">
                                    <h5 style="font-size: 18px;" class="card-title">
                                        <i class="bi bi-geo-alt-fill icon"></i>
                                        Maps
                                    </h5>
                                    <div class="map">
                                    <iframe
                                        id = "maps"
                                        src="https://www.google.com/maps?q=-7.8329,110.9247&z=15&output=embed"
                                        width="600"
                                        height="450"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load Chart.js and the Moment.js adapter library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('Volume-Air').getContext('2d');

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Volume Air Yang Dipompa (L)',
                    data: [],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'minute',
                            tooltipFormat: 'YYYY-MM-DD HH:mm:ss',
                            displayFormats: {
                                minute: 'HH:mm',
                                second: 'HH:mm:ss'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Waktu'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Volume (L)'
                        }
                    }
                }
            }
        });



        var dayaCtx = document.getElementById('Daya-Listrik').getContext('2d');
        var dayaChart = new Chart(dayaCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Daya Listrik Hari Ini (Watt)',
                    data: [],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'minute',
                            tooltipFormat: 'YYYY-MM-DD HH:mm:ss',
                            displayFormats: {
                                minute: 'HH:mm',
                                second: 'HH:mm:ss'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Waktu'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Daya (Watt)'
                        }
                    }
                }
            }
        });


        let lastTimestamp = null;

        function fetchLatestData() {
            fetch('{{ route('pompa.grafik') }}')
                .then(response => response.json())
                .then(responseData => {
                    const newData = responseData.data;

                    newData.forEach(entry => {
                        let time = moment(entry.updated_at);

                        if (!lastTimestamp || time.isAfter(lastTimestamp)) {
                            // Volume Air
                            chart.data.labels.push(time.toDate());
                            chart.data.datasets[0].data.push(entry.volume);

                            // Daya Listrik
                            dayaChart.data.labels.push(time.toDate());
                            dayaChart.data.datasets[0].data.push(entry.daya_dc);

                            lastTimestamp = time;

                            // Batasi titik data
                            if (chart.data.labels.length > 100) {
                                chart.data.labels.shift();
                                chart.data.datasets[0].data.shift();
                            }

                            if (dayaChart.data.labels.length > 100) {
                                dayaChart.data.labels.shift();
                                dayaChart.data.datasets[0].data.shift();
                            }
                        }
                    });

                    chart.update();
                    dayaChart.update();
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        let peakWatt = 0;
        function updateData() {
            $.ajax({
                type: 'GET',
                url: '{{ route('pompa.stats') }}',
                dataType: 'json',
                success: function(data) {
                    $('#debit').text(data.debit.toFixed(2) + ' L/Min');
                    $('#volume').text(data.volume.toFixed(2));
                    $('#kecepatan').text(((data.debit/60000) / 0.00202682991).toFixed(2)  + ' m/s'); // luas lingkaran d = 2inch

                    $('#daya').text(data.daya_dc.toFixed(2));
                    $('#tegangan').text(data.tegangan_dc.toFixed(2) + ' V');
                    $('#arus').text((data.daya_dc / data.tegangan_dc).toFixed(2) + ' A');
                    
                    if(data.daya_dc > peakWatt){
                        $('#peak').text(data.daya_dc.toFixed(2) + ' Wp');
                        peakWatt = data.daya_dc;
                    }

                    $('#energi').text(data.energi_harian.toFixed(2));
                    $('#penghematan').text('Rp ' + (data.energi_harian * 1.4447).toFixed(2));
                    $('#emisi').text((data.energi_harian * 0.00085).toFixed(2) + ' kg CO2');
                    $('#durasi').text(data.durasi_harian + ' Menit');
                    
                    const lat = data.latitude;
                    const lng = data.longitude;
                    const link = `https://www.google.com/maps?q=${lat},${lng}&z=15&output=embed`;
                    $('#maps').attr('src', link);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Failed to fetch data: " + textStatus, errorThrown);
                }
            });
        }
        

        
        // Update data setiap 5 detik
        setInterval(updateData, 5000);
        setInterval(fetchLatestData, 5000);
        updateData(); // Panggil sekali saat halaman pertama kali dimuat
        fetchLatestData();
    });
</script>

@endsection

@section('footer')
<footer class="text-center mt-5 py-3 bg-dark text-white custom-footer">
    Group Riset EcoLume <br> Teknik Elektro Fakultas Teknik Universitas Sebelas Maret
</footer>
@endsection