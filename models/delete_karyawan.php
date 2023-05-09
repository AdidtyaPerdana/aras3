<?php 

    include "../config/connection.php";
    include "../config/core.php";

    $id = $_GET["id"];

    $query = "DELETE FROM tb_karyawan WHERE id_karyawan = '$id'";
    $delete = mysqli_query($mysqli, $query);

    header("location: ${home_url}data_karyawan.php");

?>