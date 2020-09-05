<?php
$title = 'Edit Data Outlet';
require 'koneksi.php';

$query = "SELECT outlet.*, user.nama_user, user.id_user FROM outlet LEFT JOIN user ON user.outlet_id = outlet.id_outlet WHERE id_outlet  = " . $_GET['id'];
$data = mysqli_query($conn, $query);
$edit = mysqli_fetch_assoc($data);


$query2 = "SELECT user.*, outlet.nama_outlet FROM outlet RIGHT JOIN user ON user.outlet_id = outlet.id_outlet WHERE user.role = 'owner' ORDER BY user.outlet_id ASC";
$data2 = mysqli_query($conn, $query2);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_outlet'];
    $alamat = $_POST['alamat_outlet'];
    $telp = $_POST['telp_outlet'];

    $query = "UPDATE outlet SET nama_outlet = '$nama', alamat_outlet = '$alamat', telp_outlet = '$telp' WHERE id_outlet = " . $_GET['id'];

    if ($_POST['owner_new_id']) {
        $query2 = "UPDATE user SET outlet_id = '" . $_GET['id'] . "' WHERE id_user = " . $_POST['owner_new_id'];
        $query3 = "UPDATE user SET outlet_id = NULL WHERE id_user = " . $edit['id_user'];
        $update3 = mysqli_query($conn, $query3);
    } else {
        $query2 = "UPDATE user SET outlet_id = '" . $_GET['id'] . "' WHERE id_user = " . $_POST['id_owner'];
    }

    $update = mysqli_query($conn, $query);
    $update2 = mysqli_query($conn, $query2);
    if ($update == 1 && $update2 == 1) {
        $_SESSION['msg'] = 'Berhasil Mengubah Data';
        header('location:outlet.php');
    } else {
        $_SESSION['msg'] = 'Gagal Mengubah Data!!!';
        header('location:outlet.php');
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
                    <a href="outlet.php">Outlet</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?= $title; ?></a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?>
                            : <strong><?= $edit['nama_outlet']; ?></strong></div>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Nama Outlet</label>
                                <input type="text" name="nama_outlet" class="form-control form-control" id="defaultInput" value="<?= $edit['nama_outlet']; ?>" placeholder="Outlet...">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Outlet</label>
                                <textarea class="form-control" rows="5" name="alamat_outlet"><?= $edit['alamat_outlet']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">No Telepon</label>
                                <input type="text" name="telp_outlet" class="form-control form-control" id="defaultInput" value="<?= $edit['telp_outlet']; ?>" placeholder="No Telp..." maxlength="15">
                            </div>
                            <div class="form-group">
                                <?php if ($edit['nama_user'] == null) : ?>
                                    <label for="defaultSelect">Belum Ada Owner</label>
                                    <select name="id_owner" class="form-control form-control" id="defaultSelect">
                                        <?php foreach ($data2 as $owner) : ?>
                                            <option value="<?= $owner['id_user']; ?>"><?= $owner['nama_user']; ?>
                                                <?php if ($owner['outlet_id'] == null) : ?>
                                                    (Belum mempunyai outlet)
                                                <?php else : ?>
                                                    (Owner di <?= $owner['nama_outlet']; ?>)
                                                <?php endif ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                            </div>
                        <?php else : ?>
                            <label for="defaultSelect">Owner Sekarang : <?= $edit['nama_user']; ?></label>
                            <select name="owner_new_id" class="form-control form-control" id="defaultSelect">
                                <!-- <option value="">Pilih Owner Baru</option> -->
                                <?php foreach ($data2 as $owner) :  ?>
                                    <option value="<?= $owner['id_user']; ?>" selected><?= $owner['nama_user'] ?>
                                        <?php if ($owner['outlet_id'] == null) : ?>
                                            (Belum memiliki outlet)
                                        <?php else : ?>
                                            (Owner berada di <?= $owner['nama_outlet']; ?>)
                                        <?php endif ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <?php endif; ?>
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
<?php require 'footer.php';
