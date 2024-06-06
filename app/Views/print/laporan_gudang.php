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
        <h3>LAPORAN BARANG MASUK</h3>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($masuk as $item) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= date('d/m/Y H:i', strtotime($item['tgl_penjahitan'])); ?></td>
                        <td><?= $item['nama_produk']; ?></td>
                        <td><?= $item['ukuran']; ?></td>
                        <td><?= $item['jumlah']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>LAPORAN BARANG KELUAR</h3>
        <hr>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($keluar as $item) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= date('d/m/Y H:i', strtotime($item['tgl'])); ?></td>
                            <td><?= $item['nama_produk']; ?></td>
                            <td><?= $item['jumlah']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </table>
    </div>
</body>
</html>