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
        <h3>LAPORAN PEMBELIAN BAHAN</h3>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Bahan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data as  $row) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></td>
                        <td><?= date('d/m/Y', strtotime($row['tgl'])); ?></td>
                        <td><?= $row['supplier']; ?></td>
                        <td><?= $row['nama_bahan']; ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>