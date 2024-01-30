@extends('layouts.seller')

@section('content-seller')
    <div class="container py-3 px-6">
        <h1 class="text-3xl font-bold mb-4">Statistik Perpustakaan</h1>

        <div class="flex flex-col md:flex-row w-full p-2 gap-2">
            <!-- Total Baca -->
            <div class="bg-white p-4 rounded-md shadow-md">
                <div class="bg-white p-4 rounded-md shadow-md">
                    <h2 class="text-lg font-semibold mb-2">Total Baca Tahun 2024</h2>
                    <canvas id="totalBacaChart" class="w-full h-auto"></canvas>
                </div>
            </div>

            <!-- Total Baca Per User -->
            <div class="bg-white p-4 rounded-md shadow-md">
                <div class="bg-white p-4 rounded-md shadow-md mb-4">
                    <h2 class="text-lg font-semibold mb-2">Total Baca Per User</h2>
                    <canvas id="totalBacaPerUserChart" class="w-full h-auto"></canvas>
                </div>
            </div>

            <!-- Total Baca Per Konten -->
            <div class="bg-white p-4 rounded-md shadow-md">
                <div class="bg-white p-4 rounded-md shadow-md mb-4">
                    <h2 class="text-lg font-semibold mb-2">Total Baca Per Konten</h2>
                    <canvas id="totalBacaPerKontenChart" class="w-full h-auto"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <!-- Total Buku -->
            <div class="bg-white p-4 rounded-md shadow-md col-span-2">
                <div class="flex py-6 justify-between">
                  <div class="flex gap-3">
                    <button id="totalBookProdi" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Prodi</button>
                    <button id="totalBookDay" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Day</button>
                    <button id="totalBookWeek" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Week</button>
                    <button id="totalBookMonth" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Month</button>
                  </div>

                  <div class="flex gap-3">
                    <button id="totalBookBar" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Bar</button>
                    <button id="totalBookLine" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Line</button>
                  </div>
                </div>

                <div class="bg-white p-4 rounded-md shadow-md mb-4">
                    <h2 class="text-lg font-semibold mb-2">Total Buku</h2>
                    <canvas id="totalBukuChart" class="w-full h-auto"></canvas>
                </div>
            </div>

            <!-- Total Anggota -->
            <div class="bg-white p-4 rounded-md shadow-md col-span-2">
                <div class="flex py-6 justify-between">
                    <div class="flex gap-3">
                      <button id="totalAnggotaProdi" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Prodi</button>
                      <button id="totalAnggotaDay" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Day</button>
                      <button id="totalAnggotaMonth" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Month</button>
                      <button id="totalAnggotaYear" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Year</button>
                    </div>

                    <div class="flex gap-3">
                      <button id="totalAnggotaBar" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Bar</button>
                      <button id="totalAnggotaLine" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Line</button>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-md shadow-md mb-4">
                    <h2 class="text-lg font-semibold mb-2">Total Anggota</h2>
                    <canvas id="totalAnggotaChart" class="w-full h-auto"></canvas>
                </div>
            </div>

            <!-- Total Pengunjung -->
            <div class="bg-white p-4 rounded-md shadow-md col-span-2">
                <div class="bg-white p-4 rounded-md shadow-md mb-4">
                    <h2 class="text-lg font-semibold mb-2">Total Pengunjung</h2>
                    <canvas id="totalPengunjungChart" class="w-full h-auto"></canvas>
                </div>
            </div>

            <!-- Laporan Peminjaman/Eksemplar -->
            <div class="bg-white p-4 rounded-md shadow-md col-span-3">
                <h2 class="text-lg font-semibold mb-2">Laporan Peminjaman/Eksemplar</h2>
                <!-- Isi dengan filter Prodi, Tanggal, Bulan, Tahun dan data laporan peminjaman/eksemplar -->
            </div>

            <!-- Laporan Pembaca -->
            <div class="bg-white p-4 rounded-md shadow-md col-span-3">
                <h2 class="text-lg font-semibold mb-2">Laporan Pembaca</h2>
                <!-- Isi dengan filter Prodi, Tanggal, Bulan, Tahun dan data laporan pembaca -->
            </div>

            <!-- Laporan Peminjam/Orang -->
            <div class="bg-white p-4 rounded-md shadow-md col-span-3">
                <h2 class="text-lg font-semibold mb-2">Laporan Peminjam/Orang</h2>
                <!-- Isi dengan filter Prodi, Tanggal, Bulan, Tahun dan data laporan peminjam/orang -->
            </div>

            <!-- Laporan Pengunjung -->
            <div class="bg-white p-4 rounded-md shadow-md col-span-3">
                <h2 class="text-lg font-semibold mb-2">Laporan Pengunjung</h2>
                <!-- Isi dengan filter Prodi, Tanggal, Bulan, Tahun dan data laporan pengunjung -->
            </div>
        </div>
    </div>

@endsection

@push('script-seller')
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script>
        function getData(url) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success) {
                            resolve(response.data);
                        } else {
                            reject('Request was not successful');
                        }
                    },
                    error: function (error) {
                        reject('Error fetching data: ' + error);
                    }
                });
            });
        }
    </script>

    <script>
        let totalBacaData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Total Baca',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        async function fetchData() {
            try {
                const databuku = await getData('/data/baca');

                const tahun = databuku.map(entry => entry.tahun);
                const bulan = databuku.map(entry => entry.bulan);
                const totalpinjam = databuku.map(entry => parseInt(entry.totalpinjam));

                const arrtotalpinjam = [0,0,0,0,0,0,0,0,0,0,0,0];
                if(totalpinjam.length > 0){
                    for(i=0;i<totalpinjam.length;i++){
                        arrtotalpinjam[i] = totalpinjam[i];
                    }
                }

                totalBacaData.datasets[0].data = arrtotalpinjam;

                var totalbacagraph = document.getElementById('totalBacaChart').getContext('2d');
                var myChart = new Chart(totalbacagraph, {
                    type: 'line',
                    data: totalBacaData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            } catch(err) {
                console.log(err);
            }
        }

        fetchData();
    </script>

    <script>
        let totalBacaAnggota = {
            labels: [],
            datasets: [{
                label: 'Total Baca Anggota',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        async function fetchData() {
            try {
                const data = await getData('/data/totalpinjamanggota');

                const nama = data.map(entry => entry.nama);
                const tpanggota = data.map(entry => parseInt(entry.jumlahpinjamanggota));

                totalBacaAnggota.labels = nama;
                totalBacaAnggota.datasets[0].data = tpanggota;

                var totalbacaanggotagraph = document.getElementById('totalBacaPerUserChart').getContext('2d');
                var myChart = new Chart(totalbacaanggotagraph, {
                    type: 'bar',
                    data: totalBacaAnggota,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            } catch(err) {
                console.log(err);
            }
        }

        fetchData();

    </script>

    <script>
        let totalBacaKonten = {
            labels: [],
            datasets: [{
                label: 'Total Baca Per Jenis Buku',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        async function fetchData() {
            try {
                const datakonten = await getData('/data/totalbacaperbuku');

                const namajb = datakonten.map(entry => entry.namajenisbuku);
                const jmlbuku = datakonten.map(entry => parseInt(entry.jumlah));

                totalBacaKonten.labels = namajb;
                totalBacaKonten.datasets[0].data = jmlbuku;

                var totalbacakonten = document.getElementById('totalBacaPerKontenChart').getContext('2d');
                var myChart = new Chart(totalbacakonten, {
                    type: 'bar',
                    data: totalBacaKonten,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            } catch(err) {
                console.log(err);
            }
        }

        fetchData();
    </script>

    <script>
        // Data contoh untuk Total Pengunjung
        var totalPengunjungData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Total Pengunjung',
                data: [80, 100, 120, 130, 150, 170, 190, 200, 210, 220, 230, 250],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        // Konfigurasi grafik
        var totalPengunjungConfig = {
            type: 'line',
            data: totalPengunjungData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Buat grafik Total Pengunjung
        var totalPengunjungChart = new Chart(document.getElementById('totalPengunjungChart'), totalPengunjungConfig);
    </script>

    <script>
        const prodi = [
            {x: "Matematika", y: 18},
            {x: "Informatika", y: 28},
            {x: "Kimia", y: 9},
            {x: "Biologi", y: 48},
        ];

        const day = [
            {x: Date.parse('2021-11-01 00:00:00 GMT+0700'), y: 18},
            {x: Date.parse('2021-11-02 00:00:00 GMT+0700'), y: 12},
            {x: Date.parse('2021-11-03 00:00:00 GMT+0700'), y: 6},
            {x: Date.parse('2021-11-04 00:00:00 GMT+0700'), y: 9},
            {x: Date.parse('2021-11-05 00:00:00 GMT+0700'), y: 8},
            {x: Date.parse('2021-11-06 00:00:00 GMT+0700'), y: 13},
        ];
        const week = [
            {x: Date.parse('2021-11-01 00:00:00 GMT+0700'), y: 22},
            {x: Date.parse('2021-11-08 00:00:00 GMT+0700'), y: 23},
            {x: Date.parse('2021-11-15 00:00:00 GMT+0700'), y: 31},
            {x: Date.parse('2021-11-22 00:00:00 GMT+0700'), y: 6},
        ];
        const month = [
            {x: Date.parse('2021-08-01 00:00:00 GMT+0700'), y: 31},
            {x: Date.parse('2021-09-01 00:00:00 GMT+0700'), y: 68},
            {x: Date.parse('2021-10-01 00:00:00 GMT+0700'), y: 31},
            {x: Date.parse('2021-11-02 00:00:00 GMT+0700'), y: 41},
        ];
        // Data contoh untuk Total Buku
        var totalBukuData = {
            datasets: [{
                label: 'Total Pinjam Buku Per Hari',
                data: day,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Konfigurasi grafik
        var totalBukuConfig = {
            type: 'bar',
            data: totalBukuData,
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Buat grafik Total Buku
        var totalBukuChart = new Chart(document.getElementById('totalBukuChart'), totalBukuConfig);

        $('#totalBookDay').click(() => {
            totalBukuChart.config.options.scales.x.time.unit = 'day';
            totalBukuChart.config.options.scales.x.type = 'time';
            totalBukuChart.data.labels = null;
            totalBukuChart.data.datasets[0].label = 'Total Pinjam Buku Per Hari';
            totalBukuChart.data.datasets[0].data = day;
            totalBukuChart.update();
        });

        $('#totalBookWeek').click(() => {
            totalBukuChart.config.options.scales.x.time.unit = 'week';
            totalBukuChart.config.options.scales.x.type = 'time';
            totalBukuChart.data.labels = null;
            totalBukuChart.data.datasets[0].label = 'Total Pinjam Buku Per Minggu';
            totalBukuChart.data.datasets[0].data = week;
                totalBukuChart.update();
            });

            $('#totalBookMonth').click(() => {
                totalBukuChart.config.options.scales.x.time.unit = 'month';
                totalBukuChart.config.options.scales.x.type = 'time';
                totalBukuChart.data.labels = null;
                totalBukuChart.data.datasets[0].label = 'Total Pinjam Buku Per Bulan';
                totalBukuChart.data.datasets[0].data = month;
                totalBukuChart.update();
            });

            $('#totalBookProdi').click(() => {
                totalBukuChart.config.options.scales.x.type = 'category';
                totalBukuChart.data.datasets[0].label = 'Total Pinjam Buku Bedasarkan Prodi';
                totalBukuChart.data.labels = prodi.map(entry => entry.x); // Atur labels untuk skala x
                totalBukuChart.data.datasets[0].data = prodi.map(entry => entry.y); // Atur data untuk dataset
                totalBukuChart.update();
            });


            $('#totalBookBar').click(() => {
                totalBukuChart.config.type = 'bar';
                totalBukuChart.update();
            });

            $('#totalBookLine').click(() => {
                totalBukuChart.config.type = 'line';
                totalBukuChart.update();
            });
        </script>

        <script>
            const renderData = async () => {
                try {
                    const totalanggota_data = await getData('/data/totalanggota');

                    const totalanggota_day = totalanggota_data.day;
                    const totalanggota_month = totalanggota_data.month;
                    const totalanggota_year = totalanggota_data.year;
                    const totalanggota_prodi = totalanggota_data.prodi;

                    var totalAnggotaData = {
                        labels: [],
                        datasets: [{
                            label: 'Total Anggota',
                            data: totalanggota_day,
                            backgroundColor: ["#3490dc", "#38c172", "#9561e2", "#e3342f"],
                        }]
                    };

                    var totalAnggotaConfig = {
                        type: 'bar',
                        data: totalAnggotaData,
                        options: {
                            responsive: true,
                            scales: {
                                x: {
                                    type: 'time',
                                    time: {
                                        unit: 'day'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                        }
                    };

                    // Buat grafik Total Anggota
                    var totalAnggotaChart = new Chart(document.getElementById('totalAnggotaChart'), totalAnggotaConfig);

                    $('#totalAnggotaDay').click(() => {
                        totalAnggotaChart.config.options.scales.x.time.unit = 'day';
                        totalAnggotaChart.config.options.scales.x.type = 'time';
                        totalAnggotaChart.data.labels = null;
                        totalAnggotaChart.data.datasets[0].label = 'Total Anggota yang dibuat';
                        totalAnggotaChart.data.datasets[0].data = totalanggota_day;
                        totalAnggotaChart.update();
                    });

                    $('#totalAnggotaMonth').click(() => {
                        totalAnggotaChart.config.options.scales.x.time.unit = 'month';
                        totalAnggotaChart.config.options.scales.x.type = 'time';
                        totalAnggotaChart.data.labels = null;
                        totalAnggotaChart.data.datasets[0].label = 'Total Anggota yang dibuat';
                        totalAnggotaChart.data.datasets[0].data = totalanggota_month;
                        totalAnggotaChart.update();
                    });

                    $('#totalAnggotaYear').click(() => {
                        totalAnggotaChart.config.options.scales.x.time.unit = 'year';
                        totalAnggotaChart.config.options.scales.x.type = 'time';
                        totalAnggotaChart.data.labels = null;
                        totalAnggotaChart.data.datasets[0].label = 'Total Anggota yang dibuat';
                        totalAnggotaChart.data.datasets[0].data = totalanggota_year;
                        totalAnggotaChart.update();
                    });

                    $('#totalAnggotaProdi').click(() => {
                        console.log(totalanggota_prodi.map(entry => entry.x.toString()));
                        totalAnggotaChart.config.options.scales.x.type = 'category';
                        // totalAnggotaChart.config.options.scales.x.labels = totalanggota_prodi.map(entry => entry.x.toString());;
                        totalAnggotaChart.data.datasets[0].label = 'Total Anggota Bedasarkan Prodi';
                        totalAnggotaChart.data.labels = totalanggota_prodi.map(entry => entry.x);
                        totalAnggotaChart.data.datasets[0].data = totalanggota_prodi.map(entry => entry.y);
                        totalAnggotaChart.update();
                    });


                    $('#totalAnggotaBar').click(() => {
                        totalAnggotaChart.config.type = 'bar';
                        totalAnggotaChart.update();
                    });

                    $('#totalAnggotaLine').click(() => {
                        totalAnggotaChart.config.type = 'line';
                        totalAnggotaChart.update();
                    });
            } catch (err) {
                console.log(err);
            }
        }

        renderData();
    </script>
@endpush
