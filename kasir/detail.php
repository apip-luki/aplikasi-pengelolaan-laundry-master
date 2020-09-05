<?php
$title = 'Detail Pembayaran';
require 'koneksi.php';

$status = [
    'baru',
    'proses',
    'selesai',
    'diambil'
];

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.*, outlet.nama_outlet, paket_cuci.nama_paket FROM transaksi INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi INNER JOIN outlet ON outlet.id_outlet = transaksi.outlet_id INNER JOIN paket_cuci ON paket_cuci.outlet_id = transaksi.outlet_id WHERE transaksi.id_transaksi = '$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['btn-simpan'])) {
    $status = $_POST['status'];

    $query = "UPDATE transaksi SET status = '$status' WHERE id_transaksi = '$id'";
    $update = mysqli_query($conn, $query);
    if ($update == 1) {
        $msg = 'Berhasil mengubah status pembayaran';
        header('location:transaksi.php?msg=' . $msg);
        // $_SESSION['msg'] = 'Berhasil mengubah status pembayaran';
        // header('location: transaksi.php');
    } else {
        $_SESSION['msg'] = 'Gagal Mengubah Status Transaksi!!!';
        header('location:detail.php');
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
                                <input type="text" name="kode_invoice" class="form-control form-control" id="defaultInput" value="<?= $data['kode_invoice']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Outlet</label>
                                <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $data['nama_outlet']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Pelanggan</label>
                                <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $data['nama_pelanggan']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Jenis_paket</label>
                                <input type="text" name="" class="form-control form-control" id="defaultInput" value="<?= $data['nama_paket']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Jumlah</label>
                                <input type="text" name="qty" class="form-control form-control" id="defaultInput" value="<?= $data['qty']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Total Harga</label>
                                <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['total_harga']; ?>" readonly>
                            </div>
                            <?php if ($data['total_bayar'] > 0) : ?>
                                <div class="form-group">
                                    <label for="largeInput">Total Bayar</label>
                                    <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['total_bayar']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Tanggal Dibayar</label>
                                    <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['tgl_pembayaran']; ?>" readonly>
                                </div>
                            <?php else : ?>
                                <div class="form-group">
                                    <label for="largeInput">Total Bayar</label>
                                    <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="Belum Melakukan Pembayaran" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Batas Waktu Pembayaran</label>
                                    <input type="text" name="biaya_tambahan" class="form-control form-control" id="defaultInput" value="<?= $data['batas_waktu']; ?>" readonly>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="">Status Transaksi</label>
                                <select name="status" class="form-control form-control" id="defaultSelect">
                                    <?php foreach ($status as $key) : ?>
                                        <?php if ($key == $data['status']) : ?>
                                            <option value="<?= $key ?>" selected><?= $key ?></option>
                                        <?php endif ?>
                                        <option value="<?= $key ?>"><?= $key ?></option>
                                    <?php endforeach ?>
                                </select>
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