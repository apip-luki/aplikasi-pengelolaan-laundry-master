<?php
$title = 'Pilih Pelanggan';
require 'koneksi.php';

$query = 'SELECT * FROM pelanggan';
$data = mysqli_query($conn, $query);

require 'header.php';
?>

<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
            </div>
        </div>
        <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] <> '') { ?>
            <div class="alert alert-success" role="alert" id="msg">
                <?= $_SESSION['msg']; ?>
            </div>
        <?php }
        $_SESSION['msg'] = ''; ?>
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="index.php" style="color: white;">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow" style="color: white;"></i>
                </li>
                <li class="nav-item">
                    <a href="transaksi.php" style="color: white;">Transaksi</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow" style="color: white;"></i>
                </li>
                <li class="nav-item">
                    <a href="#" style="color: white;"><?= $title; ?></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <diva class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $title; ?></h4>
                        <p class="ml-auto">
                            *Jika pelanggan belum terdaftar maka daftarkan dulu melalui menu pelanggan
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 7%">#</th>
                                    <th>Nama</th>
                                    <th style="width: 20%;">No KTP</th>
                                    <th style="width: 25%;">Alamat</th>
                                    <th style="width: 15%;">Jenis Kelamin</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($plg = mysqli_fetch_assoc($data)) {
                                ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $plg['nama_pelanggan']; ?></td>
                                            <td><?= $plg['no_ktp']; ?></td>
                                            <td><?= $plg['alamat_pelanggan']; ?></td>
                                            <td><?php if ($plg['jenis_kelamin'] == 'L') {
                                                    echo "Laki-laki";
                                                } else {
                                                    echo "Perempuan";
                                                } ?>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="tambah_transaksi.php?id=<?= $plg['id_pelanggan']; ?>" type="button" class="btn btn-primary" data-original-title="pilih">
                                                        <i class="fa fa-edit"></i> Pilih
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</div>
</div>
<?php
require 'footer.php';
?>