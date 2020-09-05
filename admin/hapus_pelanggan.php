<?php
require 'koneksi.php';

$query = "DELETE FROM pelanggan WHERE id_pelanggan = " . $_GET['id'];
$delete = mysqli_query($conn, $query);

if ($delete) {
    $_SESSION['msg'] = 'Berhasil menghapus data pelanggan';
    header('location:pelanggan.php');
} else {
    $_SESSION['msg'] = 'Gagal Hapus Data!!!';
    header('location:pelanggan.php');
}
