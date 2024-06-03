<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<?php (isset($_GET['id'])) ? $id = $_GET['id'] : $id = 0; ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Absen Harian</h5>
                        <hr>
                        <p><span class="tanggal"></span></p>
                        <form action="<?= base_url('/absen/presensi'); ?>" method="post" enctype="multipart/form-data" id="form">
                            <div class="webcam-capture"></div>
                            <!-- $info = masuk, pulang, sudah pulang, sakit -->
                            <?php if ($info == 'masuk') : ?>
                                <button type="button" onclick="captureimage('0')" class="btn btn-success">Masuk</button>
                                <button type="button" onclick="captureimage('sakit')" class="btn btn-danger">Sakit</button>
                            <?php elseif ($info == 'pulang') : ?>
                                <button type="button" onclick="captureimage('0')" class="btn btn-warning">Pulang</button>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap my-3 mx-3">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="" class="img-thumbnail" width="200" alt="">
                        <div class="waktu"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <button type="button" class="btn btn-danger" disabled>Terlambat : <span class="terlambat"></span></button>
                                </div>
                                <div class="col-md-4 ms-auto ">
                                    <button type="button" class="btn btn-warning" disabled>sakit : <span class="sakit"></span></button>
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
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"></script>
<script type="text/javascript">
    // start webcame
    {
        Webcam.set({
            width: 590,
            height: 460,
            image_format: 'jpeg',
            jpeg_quality: 80,
        });

        var cameras = new Array(); //create empty array to later insert available devices
        navigator.mediaDevices.enumerateDevices() // get the available devices found in the machine
            .then(function(devices) {
                devices.forEach(function(device) {
                    var i = 0;
                    if (device.kind === "videoinput") { //filter video devices only
                        cameras[i] = device.deviceId; // save the camera id's in the camera array
                        i++;
                    }
                });
            })
        Webcam.set('constraints', {
            width: 590,
            height: 460,
            image_format: 'jpeg',
            jpeg_quality: 80,
            sourceId: cameras[0]
        });

        Webcam.attach('.webcam-capture');

        function captureimage(keterangan) {
            let info = '<?= $info ?>';
            if (keterangan == 'sakit') {
                info = 'sakit';
            }
            // jika keterangan = sakit maka keluarkan alert yang bisa input keterangan sakit
            while (keterangan == 'sakit') {
                var ket = prompt('Masukan keterangan sakit');
                // ulangi jika keterangan kosong

                if (ket == null || ket == '') {
                    alert('Keterangan sakit tidak boleh kosong');
                    continue;
                }
                keterangan = ket;
                break;
            }

            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
                $.ajax({
                    type: 'POST',
                    url: '/absen/presensi', // Ganti dengan URL endpoint di CodeIgniter 4
                    data: {
                        imageData: data_uri.split(',')[1],
                        info: info,
                        ket: keterangan,
                    },
                    success: function(response) {
                        // console.log(data_uri + ' oke nih');
                        // Callback setelah pengunggahan selesai
                        if (response.status === 'success') {
                            // Berhasil, lakukan tindakan yang sesuai
                            alert(response.message);
                            console.log(response);
                        } else {
                            // Gagal, tindakan jika diperlukan
                            console.error(response.message);
                            alert(response.message);
                        }
                        location.href = '';
                    },
                    error: function(textStatus, errorThrown) {
                        console.log(data_uri + ' gagal nih'),
                            console.error('Kesalahan dalam pengunggahan gambar.');
                        // console.log(textStatus + errorThrown);
                    }
                });
            });
        }
        // end webcame presensi
    }
</script>
<script src="js/hrd.js"></script>
<?= $this->endSection() ?>