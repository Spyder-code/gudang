<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('produksi/tampil'); ?>'">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('produksi/storeproduksi'); ?>" method="post" autocomplete="off">
                        <input type="hidden" name="id_user" value="<?= session('id') ?>">
                        <div class="mb-3">
                            <label for="id_supplier" class="form-label">Pilih Penjahit</label>
                            <select class="form-control" name="id_penjahit" id="id_penjahit" required>
                                <option value=""></option>
                                <?php foreach ($penjahit as $row) : ?>
                                    <option value="<?= $row['id_penjahit'] ?>"><?= $row['nama'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- bahan -->
                        <div class="mb-3">
                            <label for="bahan" class="form-label">Pilih Bahan</label>
                            <select class="form-control" name="id_bahan" id="id_bahan" required>
                                <option value=""></option>
                                <?php foreach ($bahan as $row) : ?>
                                    <option value="<?= $row['id_bahan'] ?>"><?= $row['nama'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Bahan</label>
                            <input type="number" class="form-control" name="jumlah_bahan" required min="1" id="stokbahan">
                        </div>
                        <!-- total bayar -->
                        <div class="mb-3">
                            <label for="total" class="form-label">Pilih Produk</label>
                            <select class="form-control" name="id_produk" id="id_produk" required>
                                <option value=""></option>
                                <?php foreach ($produk as $row) : ?>
                                    <option value="<?= $row['id_produk'] ?>"><?= $row['nama'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Ukuran</label>
                            <input type="text" class="form-control" name="ukuran" readonly id="ukuran">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Harga Produksi</label>
                            <input type="text" class="form-control" name="harga" readonly id="harga">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Produksi</label>
                            <input type="number" class="form-control" name="jumlah" required min="1" id="stok">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Biaya Produksi</label>
                            <input type="number" class="form-control" name="biaya_produksi" id="total2" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Total Biaya Produksi</label>
                            <input type="number" class="form-control" name="total_bayar" id="total" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Total Bahan</label>
                            <input type="number" class="form-control" name="total_bahan" id="totalbahan" readonly>
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

<?= $this->section('javascript') ?>
<script>
    let hargasubmit;
    let ukuransubmit;
    $(document).ready(function() {
        // Ketika dropdown produk dipilih
        $('#id_produk').on('change', function() {
            // Ambil nilai ID produk yang dipilih
            var id_produk = $(this).val();

            // Lakukan request AJAX ke controller untuk mendapatkan harga produk
            $.ajax({
                url: '<?php echo base_url('produksi/get_harga_produk') ?>',
                method: 'post',
                data: {
                    id_produk: id_produk
                },
                dataType: 'json',
                success: function(response) {
                    // Set nilai harga pada input harga
                    $('#harga').val(response.harga);
                    hargasubmit = response.harga;
                    $('#ukuran').val(response.ukuran);
                    ukuransubmit = response.ukuran;
                    // var inputNumber = document.getElementById('stokbahan');
                    // inputNumber.setAttribute('max', response.stokbahan);
                },
                error: function(xhr, status, error) {
                    $('#harga').val(0);
                    console.error(xhr.responseText);
                }
            });
        });

        $('#id_bahan').on('change', function() {
            // Ambil nilai ID bahan yang dipilih
            var id_bahan = $(this).val();

            // Lakukan request AJAX ke controller untuk mendapatkan harga bahan
            $.ajax({
                url: '<?php echo base_url('produksi/get_jumlah_bahan') ?>',
                method: 'post',
                data: {
                    id_bahan: id_bahan
                },
                dataType: 'json',
                success: function(response) {
                    // Set nilai harga pada input harga
                    // $('#harga').val(response.harga);
                    // hargasubmit = response.harga;
                    // $('#ukuran').val(response.ukuran);
                    // ukuransubmit = response.ukuran;
                    var inputNumber = document.getElementById('stokbahan');
                    inputNumber.setAttribute('max', response.stokbahan);
                },
                error: function(xhr, status, error) {
                    // $('#harga').val(0);
                    console.error(xhr.responseText);
                }
            });
        });


        $('#stok').on('change', function() {
            $('#total').val($('#harga').val() * $('#stok').val());
            $('#total2').val($('#harga').val() * $('#stok').val());
        });
        $('#stokbahan').on('change', function() {
            $('#totalbahan').val($('#stokbahan').val());
        });

        function isi() {
            $('#harga').val(hargasubmit);
            $('#total').val($('#harga').val() * $('#stok').val());
            $('#total2').val($('#harga').val() * $('#stok').val());
            $('#totalbahan').val($('#stokbahan').val());


        };
    });
</script>
<?= $this->endSection() ?>