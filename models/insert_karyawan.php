<?php 

    include "../config/connection.php";
    include "../config/core.php";

    if(isset($_POST["submit"])){
        $idKaryawan = $_POST["id_karyawan"];
        $nama_karyawan = $_POST["nama_karyawan"];
        $alamat = $_POST["alamat"];
        $tempat_lahir = $_POST["tempat_lahir"];
        $tanggal_lahir = $_POST["tanggal_lahir"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $posisi = $_POST["posisi"];

        $queryTambahKaryawan = "INSERT INTO tb_karyawan (id_karyawan, nama, alamat, tempat_lahir, tanggal_lahir, jenis_kelamin, posisi)
                                VALUES ('$idKaryawan', '$nama_karyawan', '$alamat', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$posisi')";
        
        if(mysqli_query($mysqli, $queryTambahKaryawan)){
            header("location: ${home_url}data_karyawan.php");
        } else {
            echo "ERROR: Could not able to execute $queryTambahKaryawan. " . mysqli_error($mysqli);
        }
    }

?>