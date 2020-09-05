<?php
$title = 'Tambah Transaksi';
require 'koneksi.php';

$tgl = date('Y-m-d h:i:s');
$seminggu = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
$batas_waktu = date("Y-m-d h:i:s", $seminggu);

$kode = "CLN" . date('Ymdsi');
$id_outlet = $_SESSION['outlet_id'];
$id_user = $_SESSION['user_id'];
$id_pelanggan = $_GET['id'];

$query = "SELECT nama_outlet FROM outlet WHERE id_outlet = '$id_outlet'";
$data = mysqli_query($conn, $query);
$outlet = mysqli_fetch_assoc($data);

$query2 = "SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
$data2 = mysqli_query($conn, $query2);
$pelanggan = mysqli_fetch_assoc($data2);

$query3 = "SELECT * FROM paket_cuci WHERE outlet_id = '$id_outlet'";
$paket = mysqli_query($conn, $query3);

if (isset($_POST['btn-simpan'])) {
    $kode_invoice = $_POST['kode_invoice'];
    $biaya_tambah = $_POST['biaya_tambahan'];
    $diskon = $_POST['diskon'];
    $pajak = $_POST['pajak'];

    $query4 = "INSERT INTO transaksi (outlet_id, kode_invoice, id_pelanggan, tgl, batas_waktu, biaya_tambahan, diskon, pajak, status, status_bayar, id_user) VALUES ('$id_outlet', '$kode_invoice', '$id_pelanggan', '$tgl', '$batas_waktu', '$biaya_tambah', '$diskon', '$pajak', 'baru', 'belum', '$id_user')";
    $insert = mysqli_query($conn, $query4);
    if ($insert == 1) {
        $id_paket = $_POST['id_paket'];
        $qty = $_POST['qty'];
        $query5 = mysqli_query($conn, "SELECT * FROM paket_cuci WHERE id_paket = $id_paket");
        $paket_harga = mysqli_fetch_assoc($query5);
        $total = $paket_harga['harga'] * $qty;
        $kode_invoice;
        $query6 = mysqli_query($conn, "SELECT * FROM transaksi WHERE kode_invoice = '" . $kode_invoice . "'");
        $transaksi = mysqli_fetch_assoc($query6);
        $id_transaksi = $transaksi['id_transaksi'];

        $query_detail = "INSERT INTO detail_transaksi (id_transaksi, id_paket, qty, total_harga) VALUES ('$id_transaksi', '$id_paket', '$qty', '$total')";
        $insert_detail = mysqli_query($conn, $query_detail);
        if ($insert_detail == 1) {
            // $_SESSION['msg'] = 'Berhasil menambahkan ';
            header('location:transaksi_sukses.php?id=' . $id_transaksi);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Gagal transaksi!!!</div>";
            header('location:tambah_transaksi.php');
        }
    }
}

require 'header.php';
?>
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Forms</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="index.php">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="transaksi.php">Transaksi</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?= $title; ?></a>
                </li>
            </ul>
            <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] <> '') { ?>
                <div class="alert alert-success" role="alert" id="msg">
                    <?= $_SESSION['msg']; ?>
                </div>
            <?php }
            $_SESSION['msg'] = ''; ?>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Kode Invoice</label>
                                <input type="text" name="kode_invoice" class="form-control form-control" id="defaultInput" value="<?= $kode; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Outlet</label>
                                <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $outlet['nama_outlet']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Pelanggan</label>
                                <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $pelanggan['nama_pelanggan']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Pilih Paket</label>
                                <select name="id_paket" class="form-control form-control" id="defaultSelect">
                                    <?php while ($key = mysqli_fetch_array($paket)) { ?>
                                        <option value="<?= $key['id_paket']; ?>"><?= $key['nama_paket']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Jumlah</label>
                                <input type="text" name="qty" class="form-control form-control" id="defaultInput">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Biaya Tambahan</label>
                                <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="0">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Diskon (%)</label>
                                <input type="text" name="diskon" class="form-control form-control" id="defaultInput" value="0">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Pajak</label>
                                <input type="text" name="pajak" class="form-control form-control" id="defaultInput" value="0">
                            </div>
                            <div class="card-action">
                                <button type="submit" name="btn-simpan" class="btn btn-success">Submit</button>
                                <!-- <button class="btn btn-danger">Cancel</button> -->
                                <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-danger">Batal</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>