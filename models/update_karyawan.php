<?php 

include "../config/connection.php";
include "../config/core.php";


if(isset($_POST['submit'])){
    $idKaryawan = $_POST["id_karyawan"];
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat = $_POST["alamat"];
    $tempat_lahir = $_POST["tempat_lahir"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $posisi = $_POST["posisi"];

    $sqlUpdate = "UPDATE tb_karyawan SET nama = '$nama_karyawan', alamat = '$alamat', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', posisi = '$posisi' 
                WHERE id_karyawan = '$idKaryawan'";

    if(mysqli_query($mysqli, $sqlUpdate)){
        header("location: ${home_url}data_karyawan.php");
    } else {
        echo "ERROR: Could not able to execute $sqlUpdate. " . mysqli_error($mysqli);
    }
}




?>