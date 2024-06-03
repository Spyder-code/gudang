<?= $this->extend('component/app') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h5"><?= $title ?></span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.location.href='<?= base_url('penjualan/view'); ?>'">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('penjualan/store'); ?>" method="post" autocomplete="off">
                        <input type="hidden" name="id_user" value="<?= session('username') ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">ID Produk</label>
                            <select name="id_produk" id="id_produk" class="form-control" required>
                                <option value=""></option>
                                <?php foreach ($produk as $row) : ?>
                                    <option value="<?= $row['id_produk'] ?>"><?= $row['nama'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="stok">
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" class="form-control" name="total" id="total" readonly>
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
        $('#id_produk').on('change', function() {
            // Ambil nilai ID produk yang dipilih
            var id_produk = $(this).val();

            // Lakukan request AJAX ke controller untuk mendapatkan harga produk
            $.ajax({
                url: '<?= base_url('penjualan/get_harga_produk') ?>',
                method: 'post',
                data: {
                    id_produk: id_produk
                },
                dataType: 'json',
                success: function(response) {
                    // Set nilai harga pada input harga
                    $('#harga').val(response.harga);
                    hargasubmit = response.harga;
                    var inputNumber = document.getElementById('stok');
                    inputNumber.setAttribute('max', response.stok);
                },
                error: function(xhr, status, error) {
                    $('#harga').val(0);
                    console.error(xhr.responseText);
                }
            });
        });
        $('#stok').on('change', function() {
            $('#total').val($('#harga').val() * $('#stok').val());
        });

        function isi() {
            $('#harga').val(hargasubmit);
            $('#total').val($('#harga').val() * $('#stok').val());

        };
    });
</script>
<?= $this->endSection() ?>