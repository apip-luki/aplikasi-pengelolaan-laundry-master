<?php

require 'koneksi.php';
$query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga, outlet.nama_outlet FROM transaksi INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi INNER JOIN outlet ON outlet.id_outlet = transaksi.outlet_id";
$data = mysqli_query($conn, $query);

setlocale(LC_ALL, 'id_id');
setlocale(LC_TIME, 'id_ID.utf8');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>

    <center>

        <h2>DATA LAPORAN TRANSAKSI LAUNDRY</h2>
        <h6><?= strftime('%A %d %B %Y') ?></h6>
        <h6 class="mr-auto">Oleh : <?= $_SESSION['username']; ?></h6>
        <br>
    </center>
    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 3%">#</th>
                <th>Kode</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
                <th>Pembayaran</th>
                <th>Total</th>
                <th>Outlet Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (mysqli_num_rows($data) > 0) {
                while ($trans = mysqli_fetch_assoc($data)) {
            ?>

                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $trans['kode_invoice']; ?></td>
                        <td><?= $trans['nama_pelanggan']; ?></td>
                        <td><?= $trans['status']; ?></td>
                        <td><?= $trans['status_bayar']; ?></td>
                        <td><?= 'Rp ' . number_format($trans['total_harga']); ?></td>
                        <td><?= $trans['nama_outlet']; ?></td>
                    </tr>
            <?php }
            }
            ?>
        </tbody>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>