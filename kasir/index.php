<?php
$title = 'Selamat Datang di Aplikasi Pengelolaan Laundry';
require 'koneksi.php';
require 'header.php';

setlocale(LC_ALL, 'id_id');
setlocale(LC_TIME, 'id_ID.utf8');

$query = mysqli_query($conn, "SELECT COUNT(id_transaksi) as jumlah_transaksi FROM transaksi");
$jumlah_transaksi = mysqli_fetch_assoc($query);

$query2 = mysqli_query($conn, "SELECT COUNT(id_pelanggan) as jumlah_pelanggan FROM pelanggan");
$jumlah_pelanggan = mysqli_fetch_assoc($query2);

$query3 = mysqli_query($conn, "SELECT COUNT(id_outlet) as jumlah_outlet FROM outlet");
$jumlah_outlet = mysqli_fetch_assoc($query3);

$query4 = mysqli_query($conn, "SELECT SUM(total_harga) as total_penghasilan FROM detail_transaksi INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE status_bayar = 'dibayar'");
$total_penghasilan = mysqli_fetch_assoc($query4);

$query5 = mysqli_query($conn, "SELECT SUM(total_harga) as penghasilan_tahun FROM detail_transaksi INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE status_bayar = 'dibayar' AND YEAR(tgl_pembayaran) = YEAR(NOW())");
$penghasilan_tahun = mysqli_fetch_assoc($query5);

$query6 = mysqli_query($conn, "SELECT SUM(total_harga) as penghasilan_bulan FROM detail_transaksi INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE status_bayar = 'dibayar' AND MONTH(tgl_pembayaran) = MONTH(NOW())");
$penghasilan_bulan = mysqli_fetch_assoc($query6);

$query7 = mysqli_query($conn, "SELECT SUM(total_harga) as penghasilan_minggu FROM detail_transaksi INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE status_bayar = 'dibayar' AND WEEK(tgl_pembayaran) = WEEK(NOW())");
$penghasilan_minggu = mysqli_fetch_assoc($query7);
?>

<div class="panel-header bg-secondary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h1 class="text-white pb-2 fw-bold"><?= $title; ?></h1>
                <h2 class="text-white op-7 mb-2">Kasir Dashboard</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Outlet</p>
                                <h4 class="card-title"><?= $jumlah_outlet['jumlah_outlet']; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Pelanggan</p>
                                <h4 class="card-title"><?= $jumlah_pelanggan['jumlah_pelanggan']; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="flaticon-success"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Transaksi</p>
                                <h4 class="card-title"><?= $jumlah_transaksi['jumlah_transaksi']; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="flaticon-graph"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Penghasilan</p>
                                <h4 class="card-title"><?= 'Rp ' . number_format($total_penghasilan['total_penghasilan']); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="card card-secondary">
                <div class="card-body skew-shadow">
                    <h1><?= 'Rp ' . number_format($penghasilan_tahun['penghasilan_tahun']); ?></h1>
                    <h5 class="op-8">Penghasilan Tahun <?= date('Y'); ?></h5>
                    <div class="pull-right">
                        <h3 class="fw-bold op-8">
                            <hr>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-dark bg-secondary-gradient">
                <div class="card-body bubble-shadow">
                    <h1><?= 'Rp ' . number_format($penghasilan_bulan['penghasilan_bulan']); ?></h1>
                    <h5 class="op-8">Penghasilan Bulan <?= strftime('%B'); ?></h5>
                    <div class="pull-right">
                        <h3 class="fw-bold op-8">
                            <hr>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-dark bg-secondary2">
                <div class="card-body curves-shadow">
                    <h1><?= 'Rp ' . number_format($penghasilan_minggu['penghasilan_minggu']); ?></h1>
                    <h5 class="op-8">Penghasilan Minggu Ini</h5>
                    <div class="pull-right">
                        <h3 class="fw-bold op-8">
                            <hr>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</div>
<?php
require 'footer.php';
?>
