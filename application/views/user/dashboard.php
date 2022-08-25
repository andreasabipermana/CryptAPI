<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg">
            <div class="row">
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
                                    <h6 class="font-extrabold mb-0"><?= $getProjectCount ?></h6>
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
                                    <h6 class="font-extrabold mb-0"><?= $getObjekCount ?></h6>
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
                                    <h6 class="font-extrabold mb-0"><?= $getKunciCount ?></h6>
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
                                    <h6 class="font-extrabold mb-0"><?= $getEndpointCount ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        </div>

    </section>
</div>
<script>
var base = '<?= base_url() ?>'
var options = {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Statistik API Enkrip',
        align: 'left'
    },

    series: [],
    noData: {
        text: 'Belum ada data'
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

    series: [],
    noData: {
        text: 'Belum ada data'
    },
    xaxis: {
        type: 'category'
    }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);
var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);


chart.render();
chart1.render();

var url_enkrip = base + 'Ambil/getStatistikPerHariByUser/enkrip';

$.getJSON(url_enkrip, function(response) {
    chart.updateSeries([{
        name: 'Enkrip',
        data: response
    }])
});

var url_dekrip = base + 'Ambil/getStatistikPerHariByUser/dekrip';

$.getJSON(url_dekrip, function(response) {
    chart1.updateSeries([{
        name: 'Dekrip',
        data: response
    }])
});
</script>