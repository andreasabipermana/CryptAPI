<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Project Kriptografi</h3>
                <p class="text-subtitle text-muted">Berisi Project Kriptografi yang disimpan oleh Sistem</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Project</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Daftar Project</h4>
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
                            <th>Nama Project</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Absensi Karyawan</td>
                            <td>Project Sistem Kriptografi aplikasi absensi karyawan</td>
                            <td>
                                <a href="object_kriptografi.html" class="btn icon btn-info"><i
                                        class="bi bi-info-circle"></i></a>
                                <a href="#" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
                                <a href="#" class="btn icon btn-danger"><i class="bi bi-trash"></i></a>


                            </td>
                        </tr>


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
                    <!-- <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrfs"> -->

                    <input type="hidden" id="kode" name="kode" value="">
                    <input type="hidden" id="id_klaster" name="id_klaster" value="">

                    <div class="row">
                        <div class="col-md-12" id="error-message">

                        </div>
                        <div class="col-md-12 form-group mb-4">
                            <label>Nama Project</label>
                            <input type="text" class="form-control" name="nama" id="nama" onpaste="return false"
                                autocomplete="off">
                            <input type="hidden" id="nama_projectlama" name="nama_projectlama" value="">
                            <div class="valid-feedback" style="display: block;color:grey">
                                Info : <span class="badge bg-light-warning">Tidak boleh nama project yang sudah
                                    ada</span>
                            </div>
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
$(function() {

})

function tambah() {
    // $('#formTambah')[0].reset();

    // $('#kode').val('0');
    // $kode = $('#kode').val()
    $("#modalTambah").modal('show')

    console.log('success')
    // console.log($kode)
}
</script>