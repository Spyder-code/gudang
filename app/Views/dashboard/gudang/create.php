<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('gudang/tampil'); ?>'">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('gudang/storepembelian'); ?>" method="post" autocomplete="off">
                        <input type="hidden" name="id_user" value="<?= session('id') ?>">
                        <input type="hidden" name="total_bayar" id="total_bayar">
                        <div class="mb-3">
                            <label for="id_supplier" class="form-label">Nama Mitra</label>
                            <select class="form-control" name="id_supplier" id="id_supplier">
                                <option value=""></option>
                                <?php foreach ($mitra as $row) : ?>
                                    <option class="supplier" value="<?= $row['id_mitra'] ?>"><?= $row['nama'] ?> </option>
                                    <?php endforeach; ?>>
                            </select>
                        </div>
                        <!-- bahan -->
                        <div class="mb-3">
                            <label for="bahan" class="form-label">Nama Bahan</label>
                            <select class="form-control" name="id_bahan" id="id_bahan">
                                <option value=""></option>
                                <?php foreach ($bahan as $row) : ?>
                                    <option value="<?= $row['id_bahan'] ?>"><?= $row['nama'] ?> </option>
                                    <?php endforeach; ?>>
                            </select>
                        </div>
                        <!-- Harga -->
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Bahan</label>
                            <input type="number" class="form-control" placeholder="Masukan harga" name="harga" required min="1" oninvalid="this.setCustomValidity('Wajib diisi min 1 bahan')" oninput="this.setCustomValidity('')" readonly id="harga">
                        </div>
                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Bahan</label>
                            <input type="number" class="form-control" placeholder="Masukan jumlah bahan" name="jumlah" required min="1" oninvalid="this.setCustomValidity('Wajib diisi min 1 bahan')" oninput="this.setCustomValidity('')" id="jumlah">
                        </div>
                        <!-- total bayar -->
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" id="total" class="form-control" placeholder="Masukan harga bahan" name="total" required min="1000" step="1000" oninvalid="this.setCustomValidity('Wajib diisi dengan kelipatan 1000')" oninput="this.setCustomValidity('')" readonly>
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
    $(document).ready(function() {
        // Ketika dropdown produk dipilih
        $('#id_bahan').on('change', function() {
            // Ambil nilai ID produk yang dipilih
            var id_bahan = $(this).val();

            // Lakukan request AJAX ke controller untuk mendapatkan harga bahan
            $.ajax({
                url: '<?php echo base_url('Gudang/get_harga_bahan') ?>',
                method: 'post',
                data: {
                    id_bahan: id_bahan
                },
                dataType: 'json',
                success: function(response) {
                    // Set nilai harga pada input harga
                    $('#harga').val(response.harga);
                    hargasubmit = response.harga;
                    var inputNumber = document.getElementById('jumlah');
                    inputNumber.setAttribute('max', response.jumlah);
                },
                error: function(xhr, status, error) {
                    $('#harga').val(0);
                    console.error(xhr.responseText);
                }
            });
        });
        $('#jumlah').on('change', function() {
            $('#total').val($('#harga').val() * $('#jumlah').val());
            $('#total_bayar').val($('#total').val());
        });

        function isi() {
            $('#harga').val(hargasubmit);
            $('#total').val($('#harga').val() * $('#jumlah').val());
            $('#total_bayar').val($('#total').val());
            // $('#id_supplier').val($('.supplier').val());
        };
    });
</script>
<?= $this->endSection() ?>