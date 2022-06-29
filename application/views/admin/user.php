<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User Sistem Kriptografi</h3>
                <p class="text-subtitle text-muted">Berisi data pengguna dari Sistem Kriptografi</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Daftar User</h4>
            </div>
            <div class="card-body">

                <div class="button">
                    <a href="javascript:void(0)" class="btn btn-primary float-end" onclick="tambah()">Tambah Data</a>
                </div>

                <br>
                <br>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
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

<div class="modal fade modal-borderless" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="modalTambahLabel">Form <?= $breadcrumb ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formTambah">
                    <!-- <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrfs"> -->

                    <input type="hidden" id="kode" name="kode" value="">
                    <input type="hidden" id="id_user" name="id_user" value="">

                    <div class="row">
                        <div class="col-md-12" id="error-message">

                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Nama User</label>
                            <input type="text" class="form-control" name="nama" id="nama" onpaste="return false"
                                autocomplete="off">
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="email" onpaste="return false"
                                autocomplete="off">
                            <input type="hidden" id="emaillama" name="emaillama" value="">
                            <div class="valid-feedback" style="display: block;color:grey">
                                Info : <span class="badge bg-light-warning">Tidak boleh menggunakan email yang sudah
                                    ada</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" id="username" onpaste="return false"
                                autocomplete="off">
                            <input type="hidden" id="usernamelama" name="usernamelama" value="">
                            <div class="valid-feedback" style="display: block;color:grey">
                                Info : <span class="badge bg-light-warning">Tidak boleh menggunakan username yang sudah
                                    ada</span>
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                onpaste="return false" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label>Level</label>
                            <select class="form-select" name="level" id="level">
                                <option disabled="" selected="">--Pilih Level--</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Aktif</label>
                            <select class="form-select" name="aktif" id="aktif">
                                <option disabled="" selected="">--Pilih Aktif--</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                    Tutup
                </button>
                <button type="button" class="btn btn-primary ml-1" onclick="simpan()">
                    Simpan
                </button>
            </div>
        </div>
    </div>
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
            bSortable: false
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

function tambah() {
    $('#formTambah')[0].reset();

    $('#kode').val('0');
    $kode = $('#kode').val()
    $("#modalTambah").modal('show')

    console.log('success')
    console.log($kode)
}

function ubah(id) {
    $('#formTambah')[0].reset();
    $.ajax({
        url: base + 'ambil/getUserById/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(json) {


            $('#nama').val(json.nama);
            $('#email').val(json.email);
            $('#emaillama').val(json.email);
            $('#username').val(json.username);
            $('#usernamelama').val(json.username);
            $('#level').val(json.level);
            $('#aktif').val(json.aktif);
            $('#kode').val('1');
            $('#id_user').val(id);
            $('#modalTambah').modal('show');

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}



function simpan() {
    if ($('#kode').val() == 0) {
        var url = base + 'tambah/user';
    } else {
        var url = base + 'ubah/user';
    }
    $.ajax({
        url: url,
        type: 'POST',
        data: $('#formTambah').serialize(),
        dataType: 'JSON',
        success: function(json) {
            if (json.status == 1) {
                Swal.fire({
                    title: "Berhasil!",
                    text: "Data berhasil disimpan!",
                    icon: "success",
                    button: "Oke",
                    timer: 1300
                });
                $('#table1').DataTable().ajax.reload(null, false);
                // $('#csrfs').attr('value', json.csrfHash);
                // $('#csrfs_upload').attr('value', json.csrfHash);

                $('#modalTambah').modal('toggle');

            } else {
                Swal.fire({
                    title: "Gagal!",
                    text: json.pesan,
                    icon: "error",
                    button: "Oke"
                });
                $('#msg').html(
                    '<div class="alert alert-light-warning alert-dismissible show fade"><strong>' + json
                    .pesan +
                    '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                );

                // $('#csrfs').attr('value', json.csrfHash);
                // $('#csrfs_upload').attr('value', json.csrfHash);

            }
        }
    });
}


function hapus(id) {

    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Aksi ini tidak bisa dikembalikan semula",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base + '/hapus/user/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    Swal.fire({
                        title: "Sukses",
                        icon: "success",
                        text: "Data anda berhasil dihapus",
                        type: "success",
                        timer: 1300
                    });
                    $('#table1').DataTable().ajax.reload(null, false);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire('Error deleting data');
                }
            });
        }
    })


}
</script>

<!-- <script type="text/javascript">
$(function() {


    'use strict';
    var table = $('#datatable_master_user').DataTable({

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
            orderData: [0, 1, 2]
        }, {
            targets: [3],
            orderData: [0, 1]
        }, {
            targets: [5],
            bSortable: false
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


// Onchange saat tambah
function get_kd_kab() {
    var id = $('#id_provinsi').val();
    var url = "<?php echo site_url('ambil/get_kd_kab'); ?>/" + id;
    $('#kd_kab').prop('disabled', false);
    $('#kd_kab').load(url);
    return false;
}

function get_kd_kec() {
    var id = $('#kd_kab').val();
    var url = "<?php echo site_url('ambil/get_kd_kec'); ?>/" + id;
    $('#kd_kec').prop('disabled', false);
    $('#kd_kec').load(url);
    return false;
}

function get_kd_desa() {
    var id = $('#kd_kec').val();
    var url = "<?php echo site_url('ambil/get_kd_desa'); ?>/" + id;
    $('#kd_desa').prop('disabled', false);
    $('#kd_desa').load(url);
    return false;
}

// Untuk request 
function get_kode_kab($kode, $kode_prov) {
    var url = "<?= site_url('ambil/get_kode_kab'); ?>/" + $kode + "/" + $kode_prov;
    $('#kd_kab').prop('disabled', false);
    $('#kd_kab').load(url);
    return false;
}

function get_kode_kec($kode_kec, $kode_kab) {
    var url = "<?= site_url('ambil/get_kode_kec'); ?>/" + $kode_kec + "/" + $kode_kab;
    $('#kd_kec').prop('disabled', false);
    $('#kd_kec').load(url);
    return false;
}

function get_kode_desa($kode_desa, $kode_kec) {
    var url = "<?= site_url('ambil/get_kode_desa'); ?>/" + $kode_desa + "/" + $kode_kec;
    $('#kd_desa').prop('disabled', false);
    $('#kd_desa').load(url);
    return false;
}

function add() {
    $('#kd_kab').prop('disabled', true);
    $('#kd_kec').prop('disabled', true);
    $('#kd_desa').prop('disabled', true);

    $('#formTambah')[0].reset();

    $('#kd_kab').val(0);
    $('#kd_kec').val(0);
    $('#kd_desa').val(0);

    $('#kode').val('0');
    $("#modalTambah").modal('show')
}




function simpan() {
    if ($('#kode').val() == 0) {
        var url = base + 'tambah/master_user';
    } else {
        var url = base + 'edit/master_user';
    }
    $.ajax({
        url: url,
        type: 'POST',
        data: $('#formTambah').serialize(),
        dataType: 'JSON',
        success: function(json) {
            if (json.status == 1) {
                swal({
                    title: "Berhasil!",
                    text: "Data berhasil disimpan!",
                    icon: "success",
                    button: "Oke",
                    timer: 1300
                });
                $('#datatable_master_user').DataTable().ajax.reload(null, false);
                $('#csrfs').attr('value', json.csrfHash);
                $('#csrfs_upload').attr('value', json.csrfHash);

                $('#modalTambah').modal('toggle');

            } else {
                // swal({
                //     title: "Gagal!",
                //     text: json.pesan,
                //     icon: "error",
                //     button: "Oke"
                // });
                $('#msg').html(
                    '<div class="alert alert-light-warning alert-dismissible show fade"><strong>' + json
                    .pesan +
                    '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                );

                $('#csrfs').attr('value', json.csrfHash);
                $('#csrfs_upload').attr('value', json.csrfHash);

            }
        }
    });
}


// Delete



//    Impor CSV
function impor() {
    $('#csv_file').val('');
    $("#importModal").modal('show')
}

//     function imporcsv() {
//     var form = new FormData();
//     var file_data = $('#csv_file').prop('files')[0];
//     form.append('file', file_data);

//     $.ajax({
//         url: "<?php echo base_url(); ?>import/master_user",
//         method: "POST",
//         data: form,
//         contentType: false,
//         cache: false,
//         processData: false,
//         beforeSend: function () {
//             $('#import_csv_btn').html('Importing...');
//             if (!file_data) {
//                 $('#import_csv_btn').attr('disabled', false);
//               $('#import_csv_btn').html('Import');
//               $("#import_csv").trigger("reset");
//                 $('#error-message-import').html('<div class="alert alert-light-danger alert-dismissible show fade">Harap lampirkan file!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
//             }
//         },
//         success: function (json) {
//           if (json.status == 2) {
//               $('#import_csv_btn').attr('disabled', false);
//               $('#import_csv_btn').html('Import');
//               $("#import_csv").trigger("reset");
//               $('#error-message-import').html('<div class="alert alert-light-warning alert-dismissible show fade">'+ json.pesan +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


//           } else {
//             swal({
//                 title: "Berhasil!",
//                 text: "Import Data sukses!",
//                 icon: "success",
//                 button: "Oke",
//             });
//             $('#import_csv_btn').attr('disabled', false);
//             $('#import_csv_btn').html('Import');
//             $("#import_csv").trigger("reset");
//             $('#datatable_master_user').DataTable().ajax.reload(null, false);
//             $('#importModal').modal('toggle');
//           }
//         }  
//     });

// }
</script> -->