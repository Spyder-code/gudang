<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    const ctx = document.getElementById('myChart');
    const DATA_COUNT = 7;
    const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

    const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'];
    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Pengeluaran',
                data: <?= json_encode($pengeluaran) ?>,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
            },
            {
                label: 'Pemasukan',
                data: <?= json_encode($pemasukan) ?>,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
            }
        ]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Line Chart'
                }
            }
        },
    };

    new Chart(ctx, config);
</script>
<?= $this->endSection() ?>