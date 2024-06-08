<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <!-- <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('produksi/tambahproduksi'); ?>'">Tambah Data</button> -->
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
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th scope="col">NO</th>
                        <th scope="col">no_penjahitan</th>
                        <th scope="col">produk</th>
                        <th scope="col">ukuran</th>
                        <th scope="col">jumlah produk</th>
                        <th scope="col">jumlah bahan</th>
                        <th scope="col">biaya produksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>

                        <?php foreach ($details as $user) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $user['no_penjahitan']; ?></td>
                            <td><?= $user['nama']; ?></td>
                            <td><?= $user['ukuran']; ?></td>
                            <td><?= $user['jumlah']; ?></td>
                            <td><?= $user['jumlah_bahan']; ?></td>
                            <td><?= "Rp " . number_format($user['biaya_produksi'], 0, ',', '.');  ?></td>
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