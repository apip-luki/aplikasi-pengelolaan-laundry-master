<?php
require 'koneksi.php';

$query = "DELETE FROM outlet WHERE id_outlet = " . $_GET['id'];
$delete = mysqli_query($conn, $query);

if ($delete == 1) {
    $_SESSION['msg'] = 'Berhasil Mengahapus Data';
    header('location:outlet.php?');
} else {
    $_SESSION['msg'] = 'Gagal Hapus Data!!!';
    header('location:outlet.php');
}
