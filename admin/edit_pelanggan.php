<?php
$title = 'Edit Data pelanggan';
require 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM pelanggan WHERE id_pelanggan = $id";
$queryedit = mysqli_query($conn, $query);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat_pelanggan'];
    $no_ktp = $_POST['no_ktp'];
    $telp = $_POST['telp_pelanggan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $query = "UPDATE pelanggan SET nama_pelanggan = '$nama', alamat_pelanggan = '$alamat', no_ktp = '$no_ktp', telp_pelanggan = '$telp', jenis_kelamin = '$jenis_kelamin' WHERE id_pelanggan = $id";

    $update = mysqli_query($conn, $query);
    if ($update == 1) {
        $_SESSION['msg'] = 'Berhasil mengubah data pelanggan';
        header('location: pelanggan.php');
    } else {
        $_SESSION['msg'] = 'Gagal mengubah data!!!';
        header('location:pelanggan.php');
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
                    <a href="pelanggan.php">Pelanggan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit Pelanggan</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <?php while ($edit = mysqli_fetch_array($queryedit)) {
                    ?>
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="largeInput">No KTP Pelanggan</label>
                                    <input type="text" name="no_ktp" class="form-control form-control" id="defaultInput" value="<?= $edit['no_ktp']; ?>" placeholder="No KTP...">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" class="form-control form-control" id="defaultInput" value="<?= $edit['nama_pelanggan']; ?>" placeholder="Nama...">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Pelanggan</label>
                                    <textarea class="form-control" rows="5" name="alamat_pelanggan"><?= $edit['alamat_pelanggan']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">No Telepon</label>
                                    <input type="text" name="telp_pelanggan" class="form-control form-control" id="defaultInput" value="<?= $edit['telp_pelanggan']; ?>" placeholder="No Telp...">
                                </div>
                                <div class="form-group">
                                    <label for="defaultSelect">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control form-control" id="defaultSelect">
                                        <option value="L" <?php if ($edit['jenis_kelamin'] == 'L') {
                                                                echo "selected";
                                                            } ?>>Laki-laki</option>
                                        <option value="P" <?php if ($edit['jenis_kelamin'] == 'P') {
                                                                echo "selected";
                                                            } ?>>Perempuan</option>
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
<?php } ?>
<?php require 'footer.php';
