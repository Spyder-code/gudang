<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('produksi/tambahproduksi'); ?>'">Tambah Data</button>
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
                                <th scope="col">No</th>
                                <th scope="col">No Penjahitan</th>
                                <th scope="col">ID Penjahit</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">ID Bahan</th>
                                <th scope="col">Total Bahan</th>
                                <th scope="col">ID User</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $user['no_penjahitan']; ?></td>
                                    <td><?= $user['id_penjahit']; ?></td>
                                    <td><?= $user['tgl']; ?></td>
                                    <td><?= "Rp " . number_format($user['total_bayar'], 0, ',', '.');  ?></td>
                                    <td><?= $user['id_bahan']; ?></td>
                                    <td><?= $user['total_bahan']; ?></td>
                                    <td><?= $user['id_user']; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-secondary" id="btnDetail" href="<?= base_url('produksi/detailPenjahitan/' . $user['no_penjahitan']); ?>">Detail</a>
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