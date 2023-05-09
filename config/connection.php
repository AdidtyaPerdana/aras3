<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "spk_aras_kinerja_karyawan";

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);

    if($mysqli->connect_error) {
      die('Connect Error (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
    }

?>