<?php 

    include "../config/connection.php";
    include "../config/core.php";

    $id = $_GET["id"];

    $query = "DELETE FROM tb_kriteria WHERE id_kriteria = '$id'";
    $delete = mysqli_query($mysqli, $query);

    header("Location: ${home_url}data_kriteria.php");

?>