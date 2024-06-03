<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <p class="mt-3 text-center">Penjualan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-3">
                <div class="small-box bg-light" onclick="window.location.href='<?= base_url('bos/penjualan/graphic/1hari') ?>'" style="cursor: pointer;">
                    <div class="inner">
                        <p class="mt-3 text-center">Hari Ini</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-3">
                <div class="small-box bg-success" onclick="window.location.href='<?= base_url('bos/penjualan/graphic/7hari') ?>'" style="cursor: pointer;">
                    <div class="inner">
                        <p class="mt-3 text-center">1 Pekan</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-3">
                <div class="small-box bg-secondary" onclick="window.location.href='<?= base_url('bos/penjualan/graphic/90hari') ?>'" style="cursor: pointer;">
                    <div class="inner">
                        <p class="mt-3 text-center">90 Hari</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-3">
                <div class="small-box bg-primary" onclick="window.location.href='<?= base_url('bos/penjualan/graphic/tahunan') ?>'" style="cursor: pointer;">
                    <div class="inner">
                        <p class="mt-3 text-center">Seluruhnya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>