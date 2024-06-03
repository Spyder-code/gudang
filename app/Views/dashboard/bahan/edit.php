<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('bahan'); ?>'">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('bahan/update'); ?>" method="post" autocomplete="off">
                        <input type="hidden" name="id_bahan" value="<?= $bahan['id_bahan']; ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Bahan</label>
                            <input type="text" class="form-control" placeholder="Masukan nama bahan" name="nama" value="<?= $bahan['nama']; ?>" required minlength="5" maxlength="30" oninvalid="this.setCustomValidity('Wajib diisi dengan 5-30 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Bahan</label>
                            <input type="number" class="form-control" placeholder="Masukan jumlah bahan" value="<?= $bahan['jumlah']; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Bahan</label>
                            <input type="number" class="form-control" placeholder="Masukan harga bahan" name="harga" value="<?= $bahan['harga']; ?>" required min="1000" step="1000" oninvalid="this.setCustomValidity('Wajib diisi dengan kelipatan 1000')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="panjang" class="form-label">Panjang Bahan</label>
                            <input type="text" class="form-control" placeholder="Masukan panjang bahan" name="panjang_kain" value="<?= $bahan['panjang_kain']; ?>" required maxlength="50" oninvalid="this.setCustomValidity('Wajib diisi dengan 1-50 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Bahan</label>
                            <select class="form-control" aria-label="Default select example" name="status">
                                <option selected value="Active">Pilih status bahan</option>
                                <option value="Active" <?= $bahan['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                                <option value="Inactive" <?= $bahan['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-sm btn-outline-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>