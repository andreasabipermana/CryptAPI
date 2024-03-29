<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptAPI</title>




    <link rel="stylesheet" href="<?= base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/favicon.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html"><i class="bi bi-lock"></i>CryptAPI</a>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item <?= $this->uri->segment(2) == '' ? 'active' : '' ?> ">
                            <a href="<?= base_url() ?>User/" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-item  <?= $this->uri->segment(2) == 'project' || $this->uri->segment(2) == 'objek_kriptografi' ? 'active' : '' ?> ">
                            <a href="<?= base_url() ?>User/project" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Projek</span>
                            </a>
                        </li>
                        <li class="sidebar-item  <?= $this->uri->segment(2) == 'kunci' ? 'active' : '' ?> ">
                            <a href="<?= base_url() ?>User/kunci" class='sidebar-link'>
                                <i class="bi bi-key-fill"></i>
                                <span>Kunci</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-item  <?= $this->uri->segment(2) == 'endpoint_api' || $this->uri->segment(2) == 'detail_endpoint_api' ? 'active' : '' ?> ">
                            <a href="<?= base_url() ?>User/endpoint_api" class='sidebar-link'>
                                <i class="bi bi-globe"></i>
                                <span>API Endpoint</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-item  <?= $this->uri->segment(2) == 'statistik_akses' || $this->uri->segment(2) == 'grafik_statistik' ? 'active' : '' ?>  ">
                            <a href="<?= base_url() ?>User/statistik_akses" class='sidebar-link'>
                                <i class="bi bi-graph-up"></i>
                                <span>Statistik Akses</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="<?= base_url() ?>auth/logout" class='sidebar-link'>
                                <i class="bi bi-door-open-fill"></i>
                                <span>Logout</span>
                            </a>
                        </li>



                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <?php include("user/$konten.php"); ?>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2022 &copy; Andreas Abi Permana</p>
                </div>

            </div>
        </footer>
    </div>
    </div>



</body>

</html>