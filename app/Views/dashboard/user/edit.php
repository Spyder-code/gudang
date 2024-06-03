<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('user'); ?>'">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/store'); ?>" method="post" autocomplete="off">
                        <input type="hidden" id="id-user" name="id-user" value="<?= $user['id_user'] ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required value="<?= $user['username'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label" id="lbl-pass">Password</label>
                            <input type="password" class="form-control" name="password" value="" id="password">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-control" id="jabatan" name="jabatan" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="produksi" <?= $user['jabatan'] == 'produksi' ? 'selected' : '' ?>>Bag. Produksi</option>
                                <option value="gudang" <?= $user['jabatan'] == 'gudang' ? 'selected' : '' ?>>Bag. Gudang</option>
                                <option value="penjualan" <?= $user['jabatan'] == 'penjualan' ? 'selected' : '' ?>>Bag. Penjualan</option>
                                <option value="hrd" <?= $user['jabatan'] == 'hrd' ? 'selected' : '' ?>>Bag. Hrd</option>
                                <option value="finance" <?= $user['jabatan'] == 'finance' ? 'selected' : '' ?>>Bag. Finance</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gaji" class="form-label">Gaji</label>
                            <input type="number" class="form-control" id="gaji" name="gaji" required value="<?= $user['gaji'] ?>">
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