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
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required value="">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label" id="lbl-pass">Password</label>
                            <input type="password" class="form-control" name="password" required value="" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-control" id="jabatan" name="jabatan" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="produksi">Bag. Produksi</option>
                                <option value="gudang">Bag. Gudang</option>
                                <option value="penjualan">Bag. Penjualan</option>
                                <option value="hrd">Bag. Hrd</option>
                                <option value="finance">Bag. Finance</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gaji" class="form-label">Gaji</label>
                            <input type="number" class="form-control" id="gaji" name="gaji" required>
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