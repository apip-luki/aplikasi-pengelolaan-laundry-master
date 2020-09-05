<?php
$title = 'Tambah Data Paket';
require 'koneksi.php';

$query = "SELECT * FROM outlet";
$data = mysqli_query($conn, $query);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_paket'];
    $jenis = $_POST['jenis_paket'];
    $harga = $_POST['harga'];
    $id_outlet = $_POST['outlet_id'];

    $query = "INSERT INTO paket_cuci (nama_paket, jenis_paket, harga, outlet_id) values ('$nama', '$jenis', '$harga', '$id_outlet')";
    $insert = mysqli_query($conn, $query);
    if ($insert == 1) {
        $_SESSION['msg'] = 'Berhasil tambah paket baru';
        header('location:paket.php');
    } else {
        $_SESSION['msg'] = 'Gagal menambahkan data baru';
        header('location: paket.php');
    }
}

require 'header.php'
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
                    <a href="paket.php">Paket</a>
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
                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Nama Paket</label>
                                <input type="text" name="nama_paket" class="form-control form-control" id="defaultInput" placeholder="Paket...">
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Jenis Paket</label>
                                <select name="jenis_paket" class="form-control form-control" id="defaultSelect">
                                    <option value="kiloan">Kiloan</option>
                                    <option value="selimut">Selimut</option>
                                    <option value="bedcover">Bedcover</option>
                                    <option value="kiloan">Kiloan</option>
                                    <option value="kaos">Kaos</option>
                                    <option value="lain">Lain</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" name="harga" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">Pilih Outlet</label>
                                <select name="outlet_id" class="form-control form-control" id="defaultSelect">
                                    <?php while ($key = mysqli_fetch_array($data)) { ?>
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