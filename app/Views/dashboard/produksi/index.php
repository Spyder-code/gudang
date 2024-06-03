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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">ini laman dashboard untuk bagian produksi</div>
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
                label: 'Produksi Batik Seumur Hidup',
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