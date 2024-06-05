<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?> - <?= $produk['nama']; ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('produk'); ?>'">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 250px;"><strong>Ukuran</strong> Produk</td>
                            <td><strong><?= $produk['ukuran']; ?></strong></td>
                        </tr>
                        <tr>
                            <td style="width: 250px;"><strong>Jumlah</strong> Produk</td>
                            <td><strong><?= $produk['jumlah']; ?></strong></td>
                        </tr>
                        <tr>
                            <td style="width: 250px;"><strong>Harga</strong> Produk</td>
                            <td><strong>Rp <?= number_format($produk['biaya_jual'], 0, ',', '.'); ?></strong></td>
                        </tr>
                        <tr>
                            <td style="width: 250px;"><strong>Biaya Pembuatan</strong> Produk</td>
                            <td><strong>Rp <?= number_format($produk['biaya_produksi'], 0, ',', '.'); ?></strong></td>
                        </tr>
                        <tr>
                            <td style="width: 250px;"><strong>Jumlah Produksi</strong> Per Kain</td>
                            <td><strong><?= $produk['jumlah_produksi_perkain']; ?> Pics</strong></td>
                        </tr>
                        <tr>
                            <td style="width: 250px;"><strong>Status</strong> Produk</td>
                            <td><strong><?= $produk['status']; ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>