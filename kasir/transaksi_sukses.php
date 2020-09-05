<?php
$title = 'Transaksi Sukses';
require 'koneksi.php';
require 'header.php';

$query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga FROM transaksi INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE transaksi.id_transaksi = " . $_GET['id'];
$transaksi = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($transaksi);
?>
<div class="content">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mt-3">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center" style="padding-left: 50px;padding-right: 50px;">
                                        <div class="bg-success" style="font-size: 30px;border-radius: 30px">
                                            <i class="fa fa-check fa-10x text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center mb-5">
                                        <br>
                                        <h3>Pesanan Atas Nama</h3>
                                        <h2><strong><?= $data['nama_pelanggan'] ?> </strong></h2>
                                        <h3>Berhasil Di Simpan</h3>
                                        <h3><strong>Kode Invoice <?= $data['kode_invoice'] ?></strong><br></h3>
                                        <h3><strong>Total Pembayaran <?= $data['total_harga'] ?></strong><br><br></h3>
                                        <a href="transaksi.php" class="btn btn-primary col-md-4 ml-auto mr-auto">Kembali Ke Menu Utama</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>