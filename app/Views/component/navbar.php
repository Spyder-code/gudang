<?php
    $role = session()->get('jabatan');
    $model = new \App\Models\Notifikasi();
    $notif = $model->where('to', $role)->where('is_read', '0')->orderBy('tanggal', 'DESC')->findAll();
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge"><?= count($notif) ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php foreach($notif as $n) : ?>
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="dropdown-item-title" style="text-transform: uppercase;">
                                    <?= $n['from'] ?>
                                </h3>
                                <p class="text-sm"><?= $n['pesan'] ?></p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?= date('d/m/Y H:i', strtotime($n['tanggal'])) ?></p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                <?php endforeach; ?>
                <a href="<?= base_url('notifikasi') ?>" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>