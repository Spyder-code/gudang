<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('penjahit'); ?>'">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('penjahit/update'); ?>" method="post" autocomplete="off">
                        <input type="hidden" name="id_penjahit" value="<?= $penjahit['id_penjahit']; ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Penjahit</label>
                            <input type="text" class="form-control" placeholder="Masukan nama penjahit" name="nama" value="<?= $penjahit['nama']; ?>" required minlength="5" maxlength="30" oninvalid="this.setCustomValidity('Wajib diisi dengan 5-30 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">alamat Penjahit</label>
                            <input type="text" class="form-control" placeholder="Masukan alamat penjahit" name="alamat" value="<?= $penjahit['alamat']; ?>" required minlength="7" maxlength="70" oninvalid="this.setCustomValidity('Wajib diisi dengan 7-70 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Hp Penjahit</label>
                            <input type="text" class="form-control" placeholder="Masukan No Hp penjahit" name="no_hp" value="<?= $penjahit['no_hp']; ?>" required minlength="7" maxlength="70" oninvalid="this.setCustomValidity('Wajib diisi dengan 7-70 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Penjahit</label>
                            <select class="form-control" name="status">
                                <option selected value="Active">Pilih status Penjahit</option>
                                <option value="Active" <?= $penjahit['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                                <option value="Inactive" <?= $penjahit['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
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