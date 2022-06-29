<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptAPI Login</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/main/app.css">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/favicon.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
    <div>
        <div class=" container">
            <div class="row">
                <div class="col-md-3">
                    <div class="col-12">

                    </div>
                </div>
                <div class="col-md-6 p-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title">Vertical Form with Icons</h4> -->
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <h2 class="text-center" style="color:#435ebe">Sistem Kriptografi</h2>
                                            <h2 class="text-center" style="color:#435ebe"><i class="bi bi-lock">
                                                </i>CryptAPI</h2>

                                        </div>
                                    </div>
                                    <form class="form form-vertical" method="post" action="<?=base_url()?>Auth/login"
                                        id="FormLogin" role="login">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Username</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control"
                                                                placeholder="Username" id="username" name="username">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <div class="form-group has-icon-left">
                                                        <label for="password-id-icon">Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" class="form-control"
                                                                placeholder="Password" id="password" name="password">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-lock"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Log
                                                        in</button>
                                                    <!-- <button type="submit" class="btn btn-primary me-1 mb-1">Login</button>
                                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> -->

                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center mt-5 text-lg fs-8">
                                                        <p class="text-center">2022 &copy; CV. Elang Cahaya Sukses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-12">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
$(function() {

    $('#FormLogin').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            cache: false,
            data: $(this).serialize(),
            dataType: 'json',
            success: function(json) {
                if (json.status == 1) {

                    Swal.fire({
                        title: "Sukses!",
                        text: "Login sukses!",
                        icon: "success",
                        button: "Oke",
                    });

                    function doLogout() {
                        window.location.href = json.url_home;
                    }
                    window.setTimeout(doLogout, 2000);

                }
                if (json.status == 2) {
                    Swal.fire({
                        title: "Gagal",
                        text: "Mohon cek kembali",
                        icon: "error",
                        timer: 3000
                    });

                    function doLogout() {
                        location.reload();
                    }
                    window.setTimeout(doLogout, 2000);

                }
                if (json.status == 3) {
                    Swal.fire({
                        title: "Gagal",
                        text: "Mohon cek kembali",
                        icon: "error",
                        timer: 3000
                    });

                    function doLogout() {
                        location.reload();
                    }
                    window.setTimeout(doLogout, 2000);

                }
            }
        });
    });

});
</script>

</html>