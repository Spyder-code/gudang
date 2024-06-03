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
                    <form action="<?= base_url('produk/store'); ?>" method="post" autocomplete="off">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" placeholder="Masukan nama produk" name="nama" autofocus required minlength="5" maxlength="30" oninvalid="this.setCustomValidity('Wajib diisi dengan 5-30 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="ukuran" class="form-label">Ukuran Produk</label>
                            <input type="text" class="form-control" placeholder="Masukan ukuran produk" name="ukuran" autofocus required minlength="1" maxlength="10" oninvalid="this.setCustomValidity('Wajib diisi dengan 1-10 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Produk</label>
                            <input type="number" class="form-control" placeholder="Masukan jumlah produk" name="jumlah" required min="1" oninvalid="this.setCustomValidity('Wajib diisi min 1 produk')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="biaya_jual" class="form-label">Harga Produk</label>
                            <input type="number" class="form-control" placeholder="Masukan harga produk" name="biaya_jual" required min="1000" step="1000" oninvalid="this.setCustomValidity('Wajib diisi dengan kelipatan 1000')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="biaya_produksi" class="form-label">Biaya Pembuatan Produk</label>
                            <input type="number" class="form-control" placeholder="Masukan biaya pembuatan produk" name="biaya_produksi" required min="1000" step="1000" oninvalid="this.setCustomValidity('Wajib diisi dengan kelipatan 1000')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_produksi_perkain" class="form-label">Jumlah Produksi Per Kain</label>
                            <input type="number" class="form-control" placeholder="Masukan Jumlah Produksi Per Kain" name="jumlah_produksi_perkain" required min="1" oninvalid="this.setCustomValidity('Wajib diisi')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="panjang_kain_perproduksi" class="form-label">Panjang Kain Per Produksi</label>
                            <input type="text" class="form-control" placeholder="Masukan Panjang Kain Per Produksi" name="panjang_kain_perproduksi" required oninvalid="this.setCustomValidity('Wajib diisi')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Produk</label>
                            <select class="form-control" name="status">
                                <option selected value="Active">Pilih status Produk</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
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