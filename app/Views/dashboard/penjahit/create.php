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
                    <form action="<?= base_url('penjahit/store'); ?>" method="post" autocomplete="off">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Penjahit</label>
                            <input type="text" class="form-control" placeholder="Masukan nama penjahit" name="nama" autofocus required minlength="5" maxlength="30" oninvalid="this.setCustomValidity('Wajib diisi dengan 5-30 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Penjahit</label>
                            <input type="text" class="form-control" placeholder="Masukan alamat penjahit" name="alamat" required minlength="7" maxlength="70" oninvalid="this.setCustomValidity('Wajib dengan 7-70 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Hp Penjahit</label>
                            <input type="text" class="form-control" placeholder="Masukan No Hp penjahit" name="no_hp" required minlength="5" maxlength="15" oninvalid="this.setCustomValidity('Wajib dengan 5-15 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Penjahit</label>
                            <select class="form-control" name="status">
                                <option selected value="Active">Pilih status Penjahit</option>
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