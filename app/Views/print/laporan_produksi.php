<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Gudang</title>
    <style>
        *{
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        .text-center{
            text-align: center;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td{
            border: 1px solid black;
        }
        td{
            padding: 5px;
        }
        .title{
            text-transform: uppercase;
        }
        .garis{
            width: 100%;
            height: 3px;
            background-color: black;
            border: 3px solid black;
        }
    </style>
</head>
<body>
    <h3><b class="title"><?= $title; ?></b></h3>
    <div class="garis"></div>
    <div class="text-center">
        <h3>LAPORAN PRODUKSI</h3>
        <hr>
            <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Penjahit</th>
                    <th scope="col">Bahan</th>
                    <th scope="col">Total Bahan</th>
                    <th scope="col">Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data as $user) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= date('d/m/Y', strtotime($user['tgl'])); ?></td>
                        <td><?= $user['nama_penjahit']; ?></td>
                        <td><?= $user['nama_bahan']; ?></td>
                        <td><?= $user['total_bahan']; ?></td>
                        <td><?= "Rp " . number_format($user['total_bayar'], 0, ',', '.');  ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>