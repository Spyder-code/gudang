<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Produk Terjual</span>
                        <span class="info-box-number"><?= $terjual ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clipboard-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Transaksi</span>
                        <span class="info-box-number"><?= $transaksi ?></span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-4 col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cash-register"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Keuntungan</span>
                        <span class="info-box-number">Rp. <?= number_format($total) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>