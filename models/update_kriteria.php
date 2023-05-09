<?php 

include "../config/connection.php";
include "../config/core.php";


if(isset($_POST['submit'])){
        $idKriteria = $_POST["id_kriteria"];
        $nama_kriteria = $_POST["nama_kriteria"];
        $bobot = $_POST["bobot"];

    $sqlUpdate = "UPDATE tb_kriteria SET nama = '$nama_kriteria', bobot = '$bobot' WHERE id_kriteria = '$idKriteria'";

    if(mysqli_query($mysqli, $sqlUpdate)){
        header("location: ${home_url}data_kriteria.php");
    } else {
        echo "ERROR: Could not able to execute $sqlUpdate. " . mysqli_error($mysqli);
    }
}




?>