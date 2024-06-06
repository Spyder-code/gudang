<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('produk'); ?>'">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('pembelian/update/'.$pembelian['no_pembelian']); ?>" method="post" autocomplete="off">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="tgl" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control" name="tgl" value="<?= date('Y-m-d', strtotime($pembelian['tgl'])); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_supplier" class="form-label">Supplier</label>
                            <select name="id_supplier" id="id_supplier" class="form-control form-select" required>
                                <option value="" disabled>Pilih supplier</option>
                                <?php foreach ($mitra as $row) : ?>
                                    <option <?= $pembelian['id_supplier'] == $row['id_mitra'] ? 'selected' : ''; ?> value="<?= $row['id_mitra'] ?>"><?= $row['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bahan" class="form-label">Bahan</label>
                            <select name="id_bahan" id="id_bahan" class="form-control form-select" required>
                                <option value="" selected disabled>Pilih bahan</option>
                                <?php foreach ($bahan as $row) : ?>
                                    <option <?= $pembelian_bahan['id_bahan'] == $row['id_bahan'] ? 'selected' : ''; ?> data-price="<?= $row['harga'] ?>" value="<?= $row['id_bahan'] ?>"><?= $row['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Bahan</label>
                            <input type="number" class="form-control" placeholder="Masukan harga Bahan" name="harga" id="harga" required value="<?= $pembelian_bahan['harga']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Bahan</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1" value="<?= $pembelian_bahan['jumlah']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total Biaya</label>
                            <input type="number" class="form-control" id="total" value="<?= $pembelian_bahan['total']; ?>" name="total" required  readonly>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-sm btn-outline-dark">Save</button>
                            <button type="reset" class="btn btn-sm btn-outline-dark">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
    $('#id_bahan').change(function (e) { 
        var price = $(this).find(':selected').data('price');
        $('#harga').val(price);
        if ($('#jumlah').val() > 0) {
            $('#total').val(price * $('#jumlah').val());
        }
    });

    $('#jumlah').change(function (e) { 
        if ($('#id_bahan').val() > 0) {
            $('#total').val($('#id_bahan').find(':selected').data('price') * $('#jumlah').val());
        }
    });
</script>
<?= $this->endSection() ?>