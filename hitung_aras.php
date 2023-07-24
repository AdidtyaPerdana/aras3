<?php include "./partials/header.php"; ?>

<?php

    include "./config/connection.php";
    include "./config/core.php";

    if (!isset($_SESSION['username'])) {
        header("Location: {$home_url}login.php");
    }

?>

<body class="bg-primary-color font-body text-text-color">

    <div class="flex">
        <!-- sidebar -->
        <aside class="sidebar h-screen sticky top-0 p-2 w-80 overflow-y-auto text-center bg-second-color">
            <div class="text-gray-100 text-xl">
                <div class="p-2.5 mt-1 flex items-center">
                    <i class="fab fa-dyalog px-2 py-1 bg-button-color"></i>
                    <h1 class="font-bold text-gray-200 text-[15px] ml-3">SPK Kinerja Karyawan</h1>
                </div>
                <hr class="my-2 border-1 border-[rgba(196, 196, 196, 1)]">
            </div>
            <div class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                <div class="flex justify-between items-center">
                    <i class="fas fa-user text-lg"></i>
                    <div class=" ml-4 text-left">
                        <p class="text-[15px]">Thoriq Wajedi</p>
                        <p class="font-thin text-[12px]">Admin</p>
                    </div>
                </div>
            </div>
            <hr class="my-2 border-1 border-[rgba(196, 196, 196, 1)]">
            <a href="index.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                <i class="fas fa-home text-lg"></i>
                <p class="text-sm ml-4">Beranda</p>
            </a>
            <div class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white" onclick="dropdown()">
                <i class="fas fa-table text-lg"></i>
                <div class="flex justify-between w-full items-center">
                    <span class="text-sm ml-4">Data Master</span>
                    <span class="text-lg" id="arrow">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </div>
            <div class="text-left mt-2 w-4/5 mx-auto hidden" id="submenu">
                <a href="data_karyawan.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                    <i class="fas fa-user text-lg"></i>
                    <p class="text-sm ml-4">Data Karyawan</p>
                </a>
                <a href="data_kriteria.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                    <i class="fas fa-th-list"></i>
                    <p class="text-sm ml-4">Data Kriteria</p>
                </a>
            </div>
            <a href="data_penilaian.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                <i class="fas fa-calculator text-lg"></i>
                <span class="text-sm ml-4">Penilaian</span>
            </a>
            <a href="hitung_aras.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer bg-button-color hover:bg-sky-500 text-white">
                <i class="fas fa-chart-bar text-lg"></i>
                <span class="text-sm ml-4">Metode ARAS</span>
            </a>
            <a href="laporan.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                <i class="fas fa-file text-lg"></i>
                <span class="text-sm ml-4">Laporan</span>
            </a>
        </aside>

        <!-- Content -->
        <main class="main w-full">
            <!-- navbar -->
            <div class="navbar w-full flex items-center justify-between shadow-bottom pl-2">
                <a href="logout.php" class="bg-button-color px-3 py-3 hover:bg-sky-500">Keluar</a>
            </div>

            <!-- title page -->
            <div class="flex items-center px-2 h-14">
                <h1 class="text-2xl line-height">Perhitungan Metode Additive Ratio Assessment (ARAS)</h1>
            </div>
            <hr class="border-2 border-[rgba(196, 196, 196, 1)] mx-2">

            <!-- Matrix X -->
            <div class="mt-5 mb-6 mx-2 p-2 border-2 drop-shadow-md text-sm">
                <div class="flex items-center justify-between h-14">
                    <h1 class="text-1xl line-height font-bold">Matrix X</h1>
                </div>
                <hr class="border-2 border-[rgba(196, 196, 196, 1)]">
                <table class="min-w-full divide-y divide-gray-200 mt-3 mb-4">
                    <thead class="bg-button-color">
                        <tr>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">No</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Nama</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Absensi</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Disiplin</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Kualitas Kerja</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Komunikasi</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Kerjasama</th>
                        </tr>
                    </thead>
                    <?php

                        // Mendapatkan nilai max dari setiap column kriteria
                        function getMaxValue($mysqli, $columnName){
                            $sql = "SELECT MAX($columnName) FROM tb_penilaian";
                            $hasil = mysqli_query($mysqli, $sql);
                            $row = $hasil->fetch_array();
                            return intval($row[0]);
                        }
                
                        $maxC1 = getMaxValue($mysqli, "absensi");
                        $maxC2 = getMaxValue($mysqli, "disiplin");
                        $maxC3 = getMaxValue($mysqli, "kualitas_kerja");
                        $maxC4 = getMaxValue($mysqli, "kuantitas_kerja");
                        $maxC5 = getMaxValue($mysqli, "kerjasama");

                        $no = 1;
                    ?>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-6"><?= $no ?></td>
                            <td class="py-3 px-6">A0</td>
                            <td class="py-3 px-6 text-center"><?= $maxC1 ?></td>
                            <td class="py-3 px-6 text-center"><?= $maxC2 ?></td>
                            <td class="py-3 px-6 text-center"><?= $maxC3 ?></td>
                            <td class="py-3 px-6 text-center"><?= $maxC4 ?></td>
                            <td class="py-3 px-6 text-center"><?= $maxC5 ?></td>
                        </tr>
                        <!-- Insert data karyawan -->
                        <?php
                        $sql = "SELECT * FROM tb_penilaian";
                        $result = $mysqli->query($sql);
                        if ($result !== false && $result->num_rows > 0) {
                            while ($row = $result->fetch_row()) {
                        ?>
                                <tr>
                                    <td class="py-3 px-6"><?php echo $no = $no + 1; ?></td>
                                    <td class="py-3 px-6"><?= $row[2] ?></td>
                                    <td class="py-3 px-6 text-center"><?= $row[3] ?></td>
                                    <td class="py-3 px-6 text-center"><?= $row[4] ?></td>
                                    <td class="py-3 px-6 text-center"><?= $row[5] ?></td>
                                    <td class="py-3 px-6 text-center"><?= $row[6] ?></td>
                                    <td class="py-3 px-6 text-center"><?= $row[7] ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Nilai Max dari setiap kriteria -->
                <div class="flex gap-2 italic">
                    <p>Nilai Max Setiap Kriteria</p>
                    <div class="flex gap-2 font-light">
                        <p>Absensi : <?= $maxC1 ?></p>
                        <p>Disiplin : <?= $maxC2 ?></p>
                        <p>Kualitas Kerja : <?= $maxC3 ?></p>
                        <p>Komunikasi : <?= $maxC4 ?></p>
                        <p>Kerjasama : <?= $maxC5 ?></p>
                    </div>
                </div>
            </div>

            <!-- Matrix ternormalisasi aras  -->
            <div class="mt-5 mb-6 mx-2 p-2 border-2 drop-shadow-md text-sm">
                <div class="flex items-center justify-between h-14">
                    <h1 class="text-1xl line-height font-bold">Matrix Ternormalisasi</h1>
                </div>
                <hr class="border-2 border-[rgba(196, 196, 196, 1)]">
                <table class="min-w-full divide-y divide-gray-200 mt-3 mb-4">
                    <thead class="bg-button-color">
                        <tr>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">No</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Nama</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Absensi</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Disiplin</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Kualitas Kerja</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Komunikasi</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Kerjasama</th>
                        </tr>
                    </thead>
                    <?php 

                        // Mendapatkan total penjumlahan dari setiap kolom kriteria
                        function getSumValue($mysqli, $columnName, $max){
                            $sql = "SELECT SUM($columnName) FROM tb_penilaian";
                            $hasil = mysqli_query($mysqli, $sql);
                            $row = $hasil->fetch_array();
                            return intval($row[0]) + $max;
                        }
                
                        $C1sum = getSumValue($mysqli, "absensi", $maxC1);
                        $C2sum = getSumValue($mysqli, "disiplin", $maxC2);
                        $C3sum = getSumValue($mysqli, "kualitas_kerja", $maxC3);
                        $C4sum = getSumValue($mysqli, "kuantitas_kerja", $maxC4);
                        $C5sum = getSumValue($mysqli, "kerjasama", $maxC5);
                    
                        $no = 1;
                    ?>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-6"><?= $no ?></td>
                            <td class="py-3 px-6">A0</td>
                            <td class="py-3 px-6 text-center"><?= number_format(round($maxC1/$C1sum, 3), 3) ?></td>
                            <td class="py-3 px-6 text-center"><?= number_format(round($maxC2/$C2sum, 3), 3) ?></td>
                            <td class="py-3 px-6 text-center"><?= number_format(round($maxC3/$C3sum, 3), 3) ?></td>
                            <td class="py-3 px-6 text-center"><?= number_format(round($maxC4/$C4sum, 3), 3) ?></td>
                            <td class="py-3 px-6 text-center"><?= number_format(round($maxC5/$C5sum, 3), 3) ?></td>
                        </tr>
                        <!-- Insert data karyawan -->
                        <?php
                        $sql = "SELECT * FROM tb_penilaian";
                        $result = $mysqli->query($sql);
                        if ($result !== false && $result->num_rows > 0) {
                            while ($row = $result->fetch_row()) {
                        ?>
                                <tr>
                                    <td class="py-3 px-6"><?php echo $no = $no + 1; ?></td>
                                    <td class="py-3 px-6"><?= $row[2] ?></td>
                                    <td class="py-3 px-6 text-center"><?= number_format(round($row[3]/$C1sum, 3), 3) ?></td>
                                    <td class="py-3 px-6 text-center"><?= number_format(round($row[4]/$C2sum, 3), 3) ?></td>
                                    <td class="py-3 px-6 text-center"><?= number_format(round($row[5]/$C3sum, 3), 3) ?></td>
                                    <td class="py-3 px-6 text-center"><?= number_format(round($row[6]/$C4sum, 3), 3) ?></td>
                                    <td class="py-3 px-6 text-center"><?= number_format(round($row[7]/$C5sum, 3), 3) ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Nilai Max dari setiap kriteria -->
                <div class="flex gap-2 italic">
                    <p>Nilai Penjumlahan Setiap Kriteria</p>
                    <div class="flex gap-2 font-light">
                        <p>Absensi : <?= $C1sum ?></p>
                        <p>Disiplin : <?= $C2sum ?></p>
                        <p>Kualitas Kerja : <?= $C3sum ?></p>
                        <p>Komunikasi : <?= $C4sum ?></p>
                        <p>Kerjasama : <?= $C5sum ?></p>
                    </div>
                </div>
            </div>

            <!-- Bobot matrix ternormalisasi -->
            <div class="mt-5 mb-6 mx-2 p-2 border-2 drop-shadow-md text-sm">
                <div class="flex items-center justify-between h-14">
                    <h1 class="text-1xl line-height font-bold">Bobot Matrix Ternormalisasi</h1>
                </div>
                <hr class="border-2 border-[rgba(196, 196, 196, 1)]">
                <table class="min-w-full divide-y divide-gray-200 mt-3 mb-4">
                    <thead class="bg-button-color">
                        <tr>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">No</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Nama</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Absensi</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Disiplin</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Kualitas Kerja</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Komunikasi</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Kerjasama</th>
                        </tr>
                    </thead>
                    <?php 

                        // Inisialisasi array untuk bobot kriteria
                        $bobotkriteria = [];
                        // query mendapatkan nilai bobot kriteria dan dimasukan kedalam array $boborkriteria
                        $sql = "SELECT bobot FROM tb_kriteria";
                        $hasil = mysqli_query($mysqli, $sql);
                        if($hasil->num_rows > 0){
                            while($row = $hasil->fetch_array()){
                                array_push($bobotkriteria, floatval($row[0]));
                            }
                        }
                    
                        $no = 1;
                    ?>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Alternative referensi (ideal) -->
                        <tr>
                            <td class="py-3 px-6"><?= $no ?></td>
                            <td class="py-3 px-6">A0</td>
                            <td class="py-3 px-6 text-center"><?= round(round($maxC1/$C1sum, 3) * $bobotkriteria[0], 4) ?></td>
                            <td class="py-3 px-6 text-center"><?= round(round($maxC2/$C2sum, 3) * $bobotkriteria[1], 4) ?></td>
                            <td class="py-3 px-6 text-center"><?= round(round($maxC3/$C3sum, 3) * $bobotkriteria[2], 4) ?></td>
                            <td class="py-3 px-6 text-center"><?= round(round($maxC4/$C4sum, 3) * $bobotkriteria[3], 4) ?></td>
                            <td class="py-3 px-6 text-center"><?= round(round($maxC5/$C5sum, 3) * $bobotkriteria[4], 4) ?></td>
                        </tr>
                        <!-- Insert data karyawan -->
                        <?php
                        $sql = "SELECT * FROM tb_penilaian";
                        $result = $mysqli->query($sql);
                        if ($result !== false && $result->num_rows > 0) {
                            while ($row = $result->fetch_row()) {
                        ?>
                                <tr>
                                    <td class="py-3 px-6"><?php echo $no = $no + 1; ?></td>
                                    <td class="py-3 px-6"><?= $row[2] ?></td>
                                    <td class="py-3 px-6 text-center"><?= round(round($row[3]/$C1sum, 3) * $bobotkriteria[0], 4) ?></td>
                                    <td class="py-3 px-6 text-center"><?= round(round($row[4]/$C2sum, 3) * $bobotkriteria[1], 4) ?></td>
                                    <td class="py-3 px-6 text-center"><?= round(round($row[5]/$C3sum, 3) * $bobotkriteria[2], 4) ?></td>
                                    <td class="py-3 px-6 text-center"><?= round(round($row[6]/$C4sum, 3) * $bobotkriteria[3], 4) ?></td>
                                    <td class="py-3 px-6 text-center"><?= round(round($row[7]/$C5sum, 3) * $bobotkriteria[4], 4) ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Nilai Max dari setiap kriteria -->
                <div class="flex gap-2 italic">
                    <p>Bobot Kriteria</p>
                    <div class="flex gap-2 font-light">
                        <p>Absensi : <?= $bobotkriteria[0] ?></p>
                        <p>Disiplin : <?= $bobotkriteria[1] ?></p>
                        <p>Kualitas Kerja : <?= $bobotkriteria[2] ?></p>
                        <p>Komunikasi : <?= $bobotkriteria[3] ?></p>
                        <p>Kerjasama : <?= $bobotkriteria[4] ?></p>
                    </div>
                </div>
            </div>
            
            <!-- // Hasil Akhir Perhitungan -->
            <div class="flex">
                <!-- Nilai fungsi optimum -->
                <div class="flex-auto mt-5 mb-6 mx-2 p-2 border-2 drop-shadow-md text-sm">
                    <div class="flex items-center justify-between h-14">
                        <h1 class="text-1xl line-height font-bold">Nilai Fungsi Optimum</h1>
                    </div>
                    <hr class="border-2 border-[rgba(196, 196, 196, 1)]">
                    <table class="min-w-full divide-y divide-gray-200 mt-3 mb-4">
                        <thead class="bg-button-color">
                            <tr>
                                <th class="py-3 px-6 text-left font-medium tracking-wider">No</th>
                                <th class="py-3 px-6 text-left font-medium tracking-wider">ID</th>
                                <th class="py-3 px-6 text-left font-medium tracking-wider">Nama</th>
                                <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Nilai</th>
                            </tr>
                        </thead>
                        <?php 
                            // Nilai optimum dari alternative referensi
                            $nilaiA0 = round((round($maxC1/$C1sum, 3) * $bobotkriteria[0]) + 
                                            (round($maxC2/$C2sum, 3) * $bobotkriteria[1]) +
                                            (round($maxC3/$C3sum, 3) * $bobotkriteria[2]) +
                                            (round($maxC4/$C4sum, 3) * $bobotkriteria[3]) +
                                            (round($maxC5/$C5sum, 3) * $bobotkriteria[4]), 4);
                            $no = 1;
                        ?>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Alternative referensi (ideal) -->
                            <tr>
                                <td class="py-3 px-6"><?= $no ?></td>
                                <td class="py-3 px-6">A0</td>
                                <td class="py-3 px-6">Alternative Referensi</td>
                                <td class="py-3 px-6 text-center"><?= $nilaiA0 ?></td>
                            </tr>
                            <!-- Menghitung nilai optimum dari masing-masing alternative -->
                            <?php
                            $sql = "SELECT * FROM tb_penilaian";
                            $result = $mysqli->query($sql);
                            if ($result !== false && $result->num_rows > 0) {
                                while ($row = $result->fetch_row()) {
                                    // Nilai Optimum tiap alternative
                                    $nilaiOptimum = round(
                                        (round($row[3]/$C1sum, 3) * $bobotkriteria[0]) +
                                        (round($row[4]/$C2sum, 3) * $bobotkriteria[1]) +
                                        (round($row[5]/$C3sum, 3) * $bobotkriteria[2]) +
                                        (round($row[6]/$C4sum, 3) * $bobotkriteria[3]) +
                                        (round($row[7]/$C5sum, 3) * $bobotkriteria[4]), 4
                                    );
                            ?>
                                    <tr>
                                        <td class="py-3 px-6"><?php echo $no = $no + 1; ?></td>
                                        <td class="py-3 px-6"><?= $row[1] ?></td>
                                        <td class="py-3 px-6"><?= $row[2] ?></td>
                                        <td class="py-3 px-6 text-center"><?= $nilaiOptimum  ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="flex gap-2 italic">
                        <p>Nilai Fungsi Optimal : <span class="font-light"><?= $nilaiA0 ?></span></p>
                    </div>
                </div>

                <!-- Hasil perangkingan -->
                <div class="flex-auto mt-5 mb-6 mx-2 p-2 border-2 drop-shadow-md text-sm">
                    <div class="flex items-center justify-between h-14">
                        <h1 class="text-1xl line-height font-bold">Hasil Perangkingan</h1>
                    </div>
                    <hr class="border-2 border-[rgba(196, 196, 196, 1)]">
                    <table class="min-w-full divide-y divide-gray-200 mt-3 mb-4">
                        <thead class="bg-button-color">
                            <tr>
                                <th class="py-3 px-6 text-left font-medium tracking-wider">No</th>
                                <th class="py-3 px-6 text-left font-medium tracking-wider">ID</th>
                                <th class="py-3 px-6 text-left font-medium tracking-wider">Nama</th>
                                <th class="py-3 px-6 text-left font-medium tracking-wider text-center">Nilai</th>
                            </tr>
                        </thead>
                        <?php 
                            $sql = "truncate table tb_ranGking";
                            $hasil=$mysqli->query($sql);

                            $sql = "SELECT * FROM tb_penilaian";
                            $result = $mysqli->query($sql);
                            if($result !== false && $result->num_rows > 0){
                                while($row = $result->fetch_row()){
                                    $nilaiOptimum = round(round(
                                        (round($row[3]/$C1sum, 2) * $bobotkriteria[0]) +
                                        (round($row[4]/$C2sum, 2) * $bobotkriteria[1]) +
                                        (round($row[5]/$C3sum, 2) * $bobotkriteria[2]) +
                                        (round($row[6]/$C4sum, 2) * $bobotkriteria[3]) +
                                        (round($row[7]/$C5sum, 2) * $bobotkriteria[4]), 4
                                    ) / $nilaiA0, 4);
                                    $nama = $row[2];
                                    $id = $row[1];
                                    $sql1 = "INSERT INTO tb_rangking(id_karyawan,nama,nilai) VALUES ('".$id."','".$nama."','".$nilaiOptimum."')";
                                    $hasil1=$mysqli->query($sql1);
                                }
                            }
                            $no = 1;
                        ?>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="py-3 px-6"><?= $no ?></td>
                                <td class="py-3 px-6">S0</td>
                                <td class="py-3 px-6">Fungsi Optimal</td>
                                <td class="py-3 px-6 text-center"><?= $nilaiA0 / $nilaiA0 ?></td>
                            </tr>
                            <!-- Menghitung nilai tingkatan peringkat -->
                            <?php
                            $sql = "SELECT * FROM tb_rangking ORDER BY nilai DESC";
                            $result = $mysqli->query($sql);
                            if ($result !== false && $result->num_rows > 0) {
                                while ($row = $result->fetch_row()) {

                            ?>
                                    <tr>
                                        <td class="py-3 px-6"><?php echo $no = $no + 1; ?></td>
                                        <td class="py-3 px-6"><?= $row[1] ?></td>
                                        <td class="py-3 px-6"><?= $row[2] ?></td>
                                        <td class="py-3 px-6 text-center"><?= $row[3] ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="flex gap-2 italic">
                        <p>Nilai Fungsi Optimal : <span class="font-light"><?= $nilaiA0 ?></span></p>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

<?php include "./partials/footer.php"; ?>