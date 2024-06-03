<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('mitra'); ?>'">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('mitra/store'); ?>" method="post" autocomplete="off">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mitra</label>
                            <input type="text" class="form-control" placeholder="Masukan nama mitra" name="nama" autofocus required minlength="5" maxlength="30" oninvalid="this.setCustomValidity('Wajib diisi dengan 5-30 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Mitra</label>
                            <input type="text" class="form-control" placeholder="Masukan alamat mitra" name="alamat" required minlength="7" maxlength="70" oninvalid="this.setCustomValidity('Wajib diisi dengan 7-70 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Mitra</label>
                            <input type="email" class="form-control" placeholder="Masukan email mitra" name="email" required minlength="5" maxlength="50" oninvalid="this.setCustomValidity('Wajib diisi 5-50 karakter dengan format email yang benar')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Hp Mitra</label>
                            <input type="text" class="form-control" placeholder="Masukan no Hp mitra" name="no_hp" required minlength="5" maxlength="15" oninvalid="this.setCustomValidity('Wajib diisi dengan 5-15 karakter')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Mitra</label>
                            <select class="form-control" aria-label="Default select example" name="status">
                                <option selected value="Active">Pilih status Mitra</option>
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