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
                    <style>
                        .item-description,
                        #forem {
                            display: none;
                        }

                        .scrollable {
                            overflow: auto;
                            height: 300px;
                            /* Atur tinggi sesuai kebutuhan */
                        }
                    </style>
                    <div class="row">
                        <div class="col-4">
                            <div id="list-example" class="list-group">
                                <?php
                                $noo = 0;
                                foreach ($userAll as $userss) :
                                    $noo++;
                                    if ($userss['id_user'] != session()->get('id')) :
                                        // Assume $userss['unread_count'] contains the number of unread messages
                                        $unreadCount = $userss['unread_count'];
                                ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center" id="<?= $userss['id_user']; ?>" href="javascript:void(0);" onclick="showDescription(<?= $noo; ?>, <?= $userss['id_user']; ?>); updateReceiverId(this.id); clearForm();" style="cursor: pointer;">
                                            <strong class="text-capitalize">
                                                <?= $userss['username'] ?> (<?= $userss['jabatan'] ?>)
                                            </strong>
                                            <?php if ($unreadCount > 0) : ?>
                                                <span class="badge badge-primary badge-pill"><?= $unreadCount ?></span>
                                            <?php endif; ?>
                                        </li>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="scrollspy-example" tabindex="0">
                                <div style="overflow: auto; height: 729px; padding: 10px;">
                                    <?php $noo = 0;
                                    foreach ($userAll as $userss) {
                                        $noo++;
                                        if ($userss['id_user'] != session()->get('id')) {
                                    ?>
                                            <div id="description-<?= $noo; ?>" class="item-description">
                                                <h4 class="text-capitalize"><?= $userss['username'] ?> (<?= $userss['jabatan'] ?>)</h4>
                                                <hr>
                                                <?php foreach ($messages as $pesansemua) { ?>

                                                    <?php if ($pesansemua['sender_id'] == session()->get('id') && $pesansemua['receiver_id'] == $userss['id_user']) {  ?>
                                                        <p style="text-align: right;">
                                                            <?= $pesansemua['message_content']; ?>
                                                            <br> <code><?= $pesansemua['timestamp']; ?></code>
                                                            <hr>
                                                        </p>
                                                    <?php } ?>
                                                    <?php if ($pesansemua['receiver_id'] == session()->get('id') && $pesansemua['sender_id'] == $userss['id_user']) {  ?>
                                                        <p style="text-align: left;">
                                                            <?= $pesansemua['message_content']; ?>
                                                            <br> <code><?= $pesansemua['timestamp']; ?></code>
                                                            <hr>
                                                        </p>
                                                    <?php } ?>
                                                <?php } ?>
                                                <h5 id="list-item-<?= $noo; ?>"></h5>
                                            </div>
                                    <?php }
                                    } ?>
                                    <div id="forem">
                                        <form action="<?= base_url('chatAll/sendMessage') ?>" method="post" onsubmit="return validateForm()">
                                            <input type="hidden" name="sender_id" value="<?= session()->get('id'); ?>">
                                            <input type="hidden" name="receiver_id" value="" id="receiverIdInput">
                                            <textarea class="form-control" id="message-text" name="message" placeholder="Tulis pesan" required></textarea>
                                            <br>
                                            <button type="submit" class="btn btn-outline-dark" style="margin-bottom: 5px; float: right;">Kirim</button>
                                        </form>
                                    </div>
                                    <div id="description-x" style="display: flex; justify-content: center; align-items: center;">
                                        <p><em>Silahkan pilih chat</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <script>
                        function showDescription(itemId, senderId) {
                            // Menyembunyikan semua deskripsi kecuali yang dipilih
                            for (var i = 1; i <= 99; i++) {
                                var description = document.getElementById("description-" + i);
                                var descriptionX = document.getElementById("description-x");
                                var forem = document.getElementById("forem");
                                if (description) {
                                    if (i === itemId) {
                                        description.style.display = "block";
                                    } else {
                                        description.style.display = "none";
                                    }
                                    forem.style.display = "block";
                                    descriptionX.style.display = "none";
                                }
                            }
                            // Update the message status to read
                            updateMessageStatus(senderId);
                        }

                        function updateMessageStatus(senderId) {
                            var receiverId = <?= session()->get('id'); ?>;
                            $.ajax({
                                url: '<?= base_url('chatAll/markAsRead') ?>',
                                method: 'POST',
                                data: {
                                    sender_id: senderId,
                                    receiver_id: receiverId
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        console.log('Messages marked as read');
                                    }
                                },
                                error: function() {
                                    console.error('Failed to mark messages as read');
                                }
                            });
                        }

                        // Clear form saat pindah chat
                        function clearForm() {
                            document.getElementById("message-text").value = "";
                        }

                        // tujuan receiver pada form
                        function updateReceiverId(receiverId) {
                            var receiverIdInput = document.getElementById("receiverIdInput");
                            receiverIdInput.value = receiverId;
                        }

                        // VALIDASI PESAN SEKARANG
                        function validateForm() {
                            var textareaElement = document.getElementById("message-text");
                            var message = textareaElement.value.trim(); // Menghapus spasi di awal dan akhir
                            if (message === "" || message === "\n") {
                                alert("Pesan tidak boleh kosong!");
                                return false; // Mencegah pengiriman formulir
                            }
                            return true; // Mengizinkan pengiriman formulir jika validasi lolos
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>