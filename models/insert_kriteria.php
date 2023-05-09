<?php 

    include "../config/connection.php";
    include "../config/core.php";

    if(isset($_POST["submit"])){
        $idKriteria = $_POST["id_kriteria"];
        $nama_kriteria = $_POST["nama_kriteria"];
        $bobot = $_POST["bobot"];

        $queryTambahKriteria = "INSERT INTO tb_kriteria (id_kriteria, nama, bobot)
                                VALUES ('$idKriteria', '$nama_kriteria', '$bobot')";
        
        if(mysqli_query($mysqli, $queryTambahKriteria)){
            header("location: ${home_url}data_kriteria.php");
        } else {
            echo "ERROR: Could not able to execute $queryTambahKaryawan. " . mysqli_error($mysqli);
        }
    }

?>