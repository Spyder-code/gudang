<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?></title>

  <!-- adminlte -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css" integrity="sha256-rhU0oslUDWrWDxTY4JxI2a2OdRtG7YSf3v5zcRbcySE=" crossorigin="anonymous">

  <!-- ionicon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  <script src="/js/moment.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    .time {
      color: #fff;
      margin-top: 7.5px;
      right: 5%;
      position: absolute;
    }

    @media(max-width:991px) {
      .time {
        color: #fff;
        /* margin-top: 110px; */
        /* right: 5%; */
        bottom: 0;
        position: absolute;
      }
    }

    .webcam-capture,
    .webcam-capture video {
      display: inline-block;
      width: 100% !important;
      height: auto !important;
      margin: auto;
      text-align: center;
      border-radius: 15px;
      overflow: hidden;
    }

    @media print {
      .gaprint {
        display: none;
      }

      .total {
        display: inline;
      }
    }
  </style>
</head>

<body onload="updateClock()">

  <!-- Main content -->
  <main class="container my-4">
    <?= $this->renderSection('content') ?>
  </main>
  <!-- End Main content -->
  <!-- Bootstrap 5 JavaScript -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>

  <script>
    document.getElementById('tanggal').innerHTML = moment().locale('id').format('dddd DD MMMM YYYY');

    function updateClock() {
      // document.getElementById('waktu').innerHTML = jam + ':' + menit + ':' + detik;
      document.querySelector(".jam").innerHTML = moment().locale('id').format('hh:mm:ss');
      setTimeout(updateClock, 1000);
    };
  </script>
  <?= $this->renderSection('js') ?>

</body>

</html>