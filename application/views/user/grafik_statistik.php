<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Statistik Akses Project <?= $nama_project ?></h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg">
            <!-- <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Projek</h6>
                                    <h6 class="font-extrabold mb-0">1</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Objek</h6>
                                    <h6 class="font-extrabold mb-0">6</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Kunci</h6>
                                    <h6 class="font-extrabold mb-0">7</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Endpoint API</h6>
                                    <h6 class="font-extrabold mb-0">3</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4></h4>
                        </div>
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4></h4>
                        </div>
                        <div class="card-body">
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Log Akses</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Object</th>
                                        <th>Aksi</th>
                                        <th>IP Address</th>
                                        <th>User-Agent</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>

<script>
var tabel = '<?= $tabel ?>';
var breadcrumb2 = '<?= $breadcrumb2 ?>';
var logs = '';
var base = '<?= base_url() ?>'
var id_endpoint = '<?= $id_endpoint ?>';
var nama_project = '<?= $nama_project ?>';


$(function() {


    'use strict';
    var table = $('#table1').DataTable({

        responsive: false,
        processing: true,
        serverSide: true,
        stateSave: false,
        bAutoWidth: false,

        columnDefs: [{
            targets: [0],
            orderData: [0, 1, 2]
        }, {
            targets: [1],
            orderData: [0, 1]
        }, {
            targets: [2],
            orderData: [0, 1]
        }, {
            targets: [3],
            orderData: [0, 1]
        }, {
            targets: [4],
            orderData: [0, 1]
        }],

        language: {
            searchPlaceholder: 'Pencarian ' + breadcrumb2 + '...',
            // processing: '<div class="spinner-grow text-dark" role="status" style="width: 3rem; height: 3rem;"></div>',
            processing: '<div class="preloader"> <div class="loading"> <div class="spinner-grow text-warning mb-3" style="width: 3rem; height: 3rem;" role="status"> </div> <h5 class="fw-bold">Harap Tunggu..</h5> <p style="color: #BBBBBB">Jangan Refresh</p> </div> </div>',
            sSearch: '',
            sInfoFiltered: "(difilter dari _MAX_ total data)",
            sZeroRecords: "Pencarian tidak ditemukan",
            sEmptyTable: "Data kosong",
            lengthMenu: '_MENU_ Data ' + breadcrumb2 + '  Per Halaman    ',
            sInfo: "Menampilkan _START_ s/d _END_ dari <b>_TOTAL_ data</b>",
            oPaginate: {
                "sPrevious": "Sebelumnya",
                "sNext": "Selanjutnya"
            }
        },

        ajax: {
            url: base + "tabel/" + tabel + "/" + id_endpoint,
            type: "GET",
            error: function() {

            }
        }

    });

})
var options = {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Statistik API Enkrip',
        align: 'left'
    },
    subtitle: {
        text: 'Projek' + nama_project,
        align: 'left'
    },
    series: [],
    noData: {
        text: 'Loading...'
    },
    xaxis: {
        type: 'category'
    }

}

var options1 = {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Statistik API Dekrip ',
        align: 'left'
    },
    subtitle: {
        text: 'Projek' + nama_project,
        align: 'left'
    },
    dataLabels: {
        enabled: true
    },
    series: [],
    noData: {
        text: 'Loading...'
    },
    xaxis: {
        type: 'category'
    }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);
var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);

chart.render();
chart1.render();


var url_enkrip = base + 'Ambil/getStatistikPerHariById/' + id_endpoint + '/enkrip';

$.getJSON(url_enkrip, function(response) {
    chart.updateSeries([{
        name: 'Enkrip',
        data: response
    }])
});

var url_dekrip = base + 'Ambil/getStatistikPerHariById/' + id_endpoint + '/dekrip';

$.getJSON(url_dekrip, function(response) {
    chart1.updateSeries([{
        name: 'Dekrip',
        data: response
    }])
});
</script>