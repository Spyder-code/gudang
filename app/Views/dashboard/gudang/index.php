<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<?php
if (!empty($grafik)) {
    foreach ($grafik as $key => $value) {
        $nama[] = $value['nama'];
        $jumlah[] = $value['jumlah'];
    }
} else {
    $nama = array('Data kosong');
    $jumlah = array(0);
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-download"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Barang Masuk</span>
                        <span class="info-box-number"><?= $masuk ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-upload"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Barang Keluar</span>
                        <span class="info-box-number"><?= $keluar ?></span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-box"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Produk</span>
                        <span class="info-box-number"><?= $total_produk ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-boxes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bahan</span>
                        <span class="info-box-number"><?= $total_bahan ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-capitalize">
                        ini laman dashboard untuk bagian pembelian
                    </div>
                    <div class="card-body">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    const ctx = document.getElementById('myChart3');
    // type: pie, bar, line, bubble, doughnut, polarArea, radar, scatter
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($nama); ?>,
            datasets: [{
                label: 'Pembelian Bahan',
                data: <?= json_encode($jumlah); ?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>