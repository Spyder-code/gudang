<!DOCTYPE html>
<html lang="en">

<head>
  <?= $this->include('component/head') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?= $this->include('component/navbar') ?>
    <?= $this->include('component/sidebar') ?>

    <div class="content-wrapper">
      <?= $this->include('component/breadcrumb') ?>

      <?= $this->renderSection('content') ?>
    </div>

    <?= $this->include('component/footer') ?>
  </div>

  <?= $this->include('component/javascript') ?>
</body>

</html>