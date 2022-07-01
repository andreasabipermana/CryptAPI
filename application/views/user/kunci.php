<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kunci Kriptografi</h3>
                <p class="text-subtitle text-muted">Berisi Kunci yang disimpan oleh Sistem</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Kunci</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Daftar Kunci API</h4>
            </div>
            <br>
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
                            <th>Nama Kunci</th>
                            <th>Keterangan</th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="modalTambahLabel">Form <?= $breadcrumb ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formTambah">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrfs">

                    <input type="hidden" id="kode" name="kode" value="">
                    <input type="hidden" name="id_kunci" id="id_kunci" value="">

                    <div class="row">
                        <div class="col-md-12" id="error-message">

                        </div>
                        <div class="col-md-12 form-group mb-4">
                            <label>Nama Kunci</label>
                            <input type="text" class="form-control" name="nama_kunci" id="nama_kunci"
                                onpaste="return false" autocomplete="off">
                            <input type="hidden" id="nama_kuncilama" name="nama_kuncilama" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 form-group mb-4">
                            <label>Kunci</label>
                            <input type="text" class="form-control" name="kunci" id="kunci" onpaste="return false"
                                autocomplete="off">
                            <input type="hidden" id="kuncilama" name="kuncilama" value="">
                            <div class="valid-feedback" style="display: block;color:grey">
                                Info : <span class="badge bg-light-warning">Kunci 256bit disimpan dalam bentuk
                                    Base64</span>
                            </div>
                        </div>
                        <div class="col-md-2 form-group mb-4">
                            <label> </label>
                            <button type="button" class=" form-control btn btn-info ml-1" onclick="bangkitkan()">
                                <i class='bi bi-gear-fill'></i>
                            </button>
                        </div>
                    </div>

                    <div class="col form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
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
        url: base + 'ambil/getKunciById/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(json) {


            $('#nama_kunci').val(json.nama_kunci);
            $('#nama_kuncilama').val(json.nama_kunci);
            $('#keterangan').val(json.keterangan);
            $('#kunci').val(json.kunci);
            $('#kuncilama').val(json.kunci);
            $('#kode').val('1');
            $('#id_kunci').val(id);
            $('#modalTambah').modal('show');


        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function bangkitkan() {
    $.ajax({
        url: base + 'ambil/bangkitkanKunci/',
        type: "GET",
        dataType: "JSON",
        success: function(json) {
            $('#kunci').val(json.kunci);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function simpan() {
    if ($('#kode').val() == 0) {
        var url = base + 'tambah/kunci';
    } else {
        var url = base + 'ubah/kunci';
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
                }).then(function() {

                    $('#table1').DataTable().ajax.reload(null, false);
                    $('#csrfs').val(json.csrfHash);

                    location.reload()
                    $('#modalTambah').modal('toggle');
                })

            } else {
                Swal.fire({
                    title: "Gagal!",
                    text: json.pesan,
                    icon: "error",
                    button: "Oke"
                });
                $('#msg').html(
                    '<div class="alert alert-light-warning alert-dismissible show fade"><strong>' +
                    json
                    .pesan +
                    '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                );

                $('#csrfs').val(json.csrfHash);

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
            var token = $('input[name="<?php echo $this->security->get_csrf_token_name(); ?>"]').attr(
                '<?php echo $this->security->get_csrf_hash(); ?>')
            $.ajaxSetup({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Csrf-Token', token);
                }
            });
            $.ajax({
                url: base + '/hapus/kunci/' + id,
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