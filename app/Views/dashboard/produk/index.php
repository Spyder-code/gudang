<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <?php if ( session()->get('jabatan') == 'gudang') : ?>
                            <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('produk/create'); ?>'">Tambah Data</button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= session()->getFlashdata('success'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php elseif (!empty(session()->getFlashdata('info'))) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= session()->getFlashdata('info'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif ?>

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($produk as  $row) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['jumlah']; ?></td>
                                    <td>Rp <?= number_format($row['biaya_jual'], 0, ',', '.'); ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-secondary" id="btnDetail" href="<?= base_url('produk/detail/' . $row['id_produk']); ?>">Detail</a>
                                        <a href="<?= base_url('produk/edit/' . $row['id_produk']); ?>" class="btn btn-sm btn-outline-success">Edit</a>
                                        <?php if ( session()->get('jabatan') == 'gudang') : ?>
                                            <a href="<?= base_url('gudang/ajukan_produksi/' . $row['id_produk']); ?>" class="btn btn-sm btn-outline-warning">Ajukan Produksi</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>
<?= $this->endSection() ?>