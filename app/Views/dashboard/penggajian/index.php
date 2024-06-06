<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<?php if (isset($_GET['id'])) : ?>
    <?php $id = $_GET['id']; ?>
    <?php $nama = $_GET['nama'] ?>
    <script>
        var id = <?= $id ?>;
    </script>
<?php else : ?>
    <?php $nama = session('username') ?>
    <script>
        var id = 0;
    </script>
<?php endif ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="text-center">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#tataTertibPenggajian" aria-expanded="false" aria-controls="tataTertibPenggajian">
                                Tata Tertib Penggajian
                            </button>
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#tataTertibAbsen" aria-expanded="false" aria-controls="tataTertibAbsen">
                                Tata Tertib Absen
                            </button>
                        </p>
                        <div class="collapse" id="tataTertibPenggajian">
                            <div class="card card-body">
                                <ul>
                                    <li>HRD mengapprove gaji bulanan setiap akhir bulan</li>
                                    <li>gaji karyawan = dihitung dari total jam masuk karyawan jika masih 8 jam walaupun terlambat maka tidak dikurangi jika kurang dari 8 jam maka dikurangi 15000 perhari jika kelebihan dari 8 jam itu lebih dari 1 jam maka dihitung lembur 10000 </li>
                                    <li>Bulan Ini = <?= $kerja['hari_kerja_sebulan'] * 8 ?> Jam / <?= $kerja['hari_kerja_sebulan']  ?> Hari </li>
                                </ul>
                            </div>
                        </div>
                        <div class="collapse" id="tataTertibAbsen">
                            <div class="card card-body">
                                <ul>
                                    <li>
                                        Jam kerja dimulai setiap hari pukul 08.00 - 16.00 WIB kecuali Hari Jumat (libur)
                                    </li>
                                    <li>
                                        absen memiliki batas keterlambatan 15 menit
                                    </li>
                                    <li>
                                        Pegawai yang tidak mengganti jam kerja, ketika sampai di akhir bulan akan dikenai pemotongan gaji sebanyak
                                        Rp10.000 perjamnya
                                    </li>
                                    <li>
                                        total jam kerja selama satu minggu adalah 48 jam terhitung 8x6 hari, kelebihan daripada itu dihitung jam
                                        lembur
                                    </li>
                                    <li>
                                        pegawai lembur diberikan gaji tambahan sebesar Rp15.000 per jamnya dengan catatan di setujui oleh atasan
                                    </li>
                                    <li>
                                        dengan catatan lembur yang dilakukan dilakukan di luar jam kerja serta telah melebihi jam kerja mingguan
                                    </li>
                                    <li>
                                        Setiap pegawai yang mengalami sakit, harus mengajukan surat keterangan sakit ke HRD
                                    </li>
                                    <li>
                                        ijin sakit akan diberikan, dan dilakukan pengurangan jam kerja
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Gaji Bulan <span class="bulan-gaji"></span></h4>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-primary" onclick="verify()" <?= $approve ?>>Approve Gaji</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th hidden>id pegawai</th>
                                    <th>Nama</th>
                                    <th>Gaji Pokok</th>
                                    <th data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="full : <?= $kerja['hari_kerja_sebulan'] ?> hari">Hari Masuk</th>
                                    <th data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="full : <?= $kerja['hari_kerja_sebulan'] * 8 ?> jam">Total Jam </th>
                                    <th>terlambat</th>
                                    <th>sakit</th>
                                    <th>Gaji Bulan Ini</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php foreach ($penggajian as $p) : ?>
                                <tr>
                                    <td hidden><?= $p['id_pegawai'] ?></td>
                                    <td class="text-capitalize"><?= $p['nama'] ?></td>
                                    <td><?= "Rp " . number_format($p['gaji'], 0, ',', '.');  ?></td>
                                    <td><?= $p['masuk'] ?></td>
                                    <td><?= $p['jam_kerja'] ?></td>
                                    <td><?= $p['telat'] ?></td>
                                    <td><?= $p['sakit'] ?></td>
                                    <td><?= "Rp" . number_format($p['gaji_sekarang'], 0, ',', '.');  ?></td>
                                    <td>
                                        <a href="<?= base_url('penggajian?id=' . $p['id_pegawai']) . '&nama=' . $p['nama'] ?>">detail</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Absen <?= $nama ?></h4>
                        <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap my-3 mx-3">
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Absen</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="" class="img-thumbnail" width="200" alt="">
                                <div class="waktu"></div>
                            </div>
                            <div class="modal-footer">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="btn btn-danger" disabled>Terlambat : <span class="terlambat"></span></button>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-warning" disabled>sakit : <span class="sakit"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        $('#table').DataTable({
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
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
<script src="js/hrd.js"></script>
<script src="js/moment.js"></script>
<script>
    $('.bulan-gaji').text(moment().locale('id').format('MMMM YYYY'));
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<?= $this->endSection() ?>