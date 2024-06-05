<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
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

                    <form action="<?= base_url('produksi/laporan'); ?>" method="GET" class="row">
                        <div class="col-3">
                            <label for="">Bulan</label>
                            <select name="month" id="month" class="form-control form-select" onchange="submit()">
                                <option <?= $month=='01'  ? 'selected' : ''?> value="01">Januari</option>
                                <option <?= $month=='02'  ? 'selected' : ''?> value="02">Februari</option>
                                <option <?= $month=='03'  ? 'selected' : ''?> value="03">Maret</option>
                                <option <?= $month=='04'  ? 'selected' : ''?> value="04">April</option>
                                <option <?= $month=='05'  ? 'selected' : ''?> value="05">Mei</option>
                                <option <?= $month=='06'  ? 'selected' : ''?> value="06">Juni</option>
                                <option <?= $month=='07'  ? 'selected' : ''?> value="07">Juli</option>
                                <option <?= $month=='08'  ? 'selected' : ''?> value="08">Agustus</option>
                                <option <?= $month=='09'  ? 'selected' : ''?> value="09">September</option>
                                <option <?= $month=='10'  ? 'selected' : ''?> value="10">Oktober</option>
                                <option <?= $month=='11'  ? 'selected' : ''?> value="11">November</option>
                                <option <?= $month=='12'  ? 'selected' : ''?> value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="">Tahun</label>
                            <select name="year" id="year" class="form-control form-select" onchange="submit()">
                                <option <?= $year=='2022'  ? 'selected' : ''?> value="2022">2022</option>
                                <option <?= $year=='2023'  ? 'selected' : ''?> value="2023">2023</option>
                                <option <?= $year=='2024'  ? 'selected' : ''?> value="2024">2024</option>
                                <option <?= $year=='2025'  ? 'selected' : ''?> value="2025">2025</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <span class="h5">Laporan Penjualan</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Penjualan</th>
                                <th>Tanggal</th>
                                <th>Total Bayar</th>
                                <th>ID User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $totalpemasukan = 0; ?>
                            <?php foreach ($data as $item) : ?>
                                <tr>
                                    <th><?= $no++; ?></th>
                                    <td><?= $item['id_penjualan']; ?></td>
                                    <td><?= $item['tgl']; ?></td>
                                    <td><?= "Rp " . number_format($item['total_bayar'], 0, ',', '.');  ?></td>
                                    <td><?= $item['id_user']; ?></td>
                                </tr>
                                <?php $totalpemasukan += $item['total_bayar'] ?>
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
        $(".table").DataTable({
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