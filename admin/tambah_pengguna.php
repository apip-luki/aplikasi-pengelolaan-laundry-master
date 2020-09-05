<?php
$title = 'Tambah Data Pengguna';
require 'koneksi.php';

$outlet = mysqli_query($conn, "SELECT * FROM outlet");
if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $id_outlet = $_POST['id_outlet'];
    $query = "INSERT INTO user (nama_user, username, password, role, outlet_id) values ('$nama', '$username', '$password', '$role', '$id_outlet')";

    $insert = mysqli_query($conn, $query);
    if ($insert == 1) {

        $_SESSION['msg'] = 'Berhasil menambahkan ' . $role . ' baru';
        header('location:pengguna.php');
    } else {
        $_SESSION['msg'] = 'Gagal mengubah data!!!';
        header('location: pengguna.php');
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
                    <a href="pengguna.php">Pengguna</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tambah Pengguna</a>
                </li>
            </ul>
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
                                <label for="largeInput">Nama Pengguna</label>
                                <input type="text" name="nama_user" class="form-control form-control" id="defaultInput" placeholder="Nama...">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Username</label>
                                <input type="text" name="username" class="form-control form-control" id="defaultInput" placeholder="Username...">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Password</label>
                                <input type="text" name="password" class="form-control form-control" id="defaultInput" placeholder="Pass...">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Role</label>
                                <select name="role" class="form-control form-control" id="defaultSelect">
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="owner">Owner</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Pilih Outlet</label>
                                <select name="id_outlet" class="form-control form-control" id="defaultSelect">
                                    <?php while ($key = mysqli_fetch_array($outlet)) { ?>
                                        <option value="<?= $key['id_outlet']; ?>"><?= $key['nama_outlet']; ?></option>
                                    <?php } ?>
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