<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Statistik Akses Endpoint API Kriptografi</h3>
                <p class="text-subtitle text-muted">Berisi Statistik Akses Endpoint API yang dijalankan oleh Sistem</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Statistik Akses</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Daftar Endpoint API</h4>
            </div>
            <br>
            <div class="card-body">

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nama Project</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>




<script type="text/javascript">
var tabel = '<?= $tabel ?>';
var breadcrumb = '<?= $breadcrumb ?>';
var logs = '';
var base = '<?= base_url() ?>'

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
            searchPlaceholder: 'Pencarian ' + breadcrumb + '...',
            // processing: '<div class="spinner-grow text-dark" role="status" style="width: 3rem; height: 3rem;"></div>',
            processing: '<div class="preloader"> <div class="loading"> <div class="spinner-grow text-warning mb-3" style="width: 3rem; height: 3rem;" role="status"> </div> <h5 class="fw-bold">Harap Tunggu..</h5> <p style="color: #BBBBBB">Jangan Refresh</p> </div> </div>',
            sSearch: '',
            sInfoFiltered: "(difilter dari _MAX_ total data)",
            sZeroRecords: "Pencarian tidak ditemukan",
            sEmptyTable: "Data kosong",
            lengthMenu: '_MENU_ Data ' + breadcrumb + '  Per Halaman    ',
            sInfo: "Menampilkan _START_ s/d _END_ dari <b>_TOTAL_ data</b>",
            oPaginate: {
                "sPrevious": "Sebelumnya",
                "sNext": "Selanjutnya"
            }
        },

        ajax: {
            url: base + "tabel/" + tabel,
            type: "GET",
            error: function() {

            }
        }

    });

})


function info(id) {
    var url = base + 'User/grafik_statistik/' + id;
    location.href = url;
}
</script>