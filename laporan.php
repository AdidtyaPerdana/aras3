<?php include "./partials/header.php"; ?>

<?php

    include "./config/connection.php";
    include "./config/core.php";

    if (!isset($_SESSION['username'])) {
        header("Location: {$home_url}login.php");
    }
    
    // Data Karyawan
    $sql = "SELECT * FROM tb_rangking";
    $query = mysqli_query($mysqli, $sql);
    while($row = $resultRangking = mysqli_fetch_array($query)){
        $nama_alternative[] = $row["nama"];
        $nilai_alternative[] = $row["nilai"];

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
                <p class="text-[15px] ml-4">Beranda</p>
            </a>
            <div class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white" onclick="dropdown()">
                <i class="fas fa-table text-lg"></i>
                <div class="flex justify-between w-full items-center">
                    <span class="text-[15px] ml-4">Data Master</span>
                    <span class="text-lg" id="arrow">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </div>
            </div>
            <div class="text-left mt-2 w-4/5 mx-auto hidden" id="submenu">
                <a href="data_karyawan.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                    <i class="fas fa-user text-lg"></i>
                    <p class="text-[15px] ml-4">Data Karyawan</p>
                </a>
                <a href="data_kriteria.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                    <i class="fas fa-th-list"></i>
                    <p class="text-[15px] ml-4">Data Kriteria</p>
                </a>
            </div>
            <a href="data_penilaian.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                <i class="fas fa-calculator text-lg"></i>
                <span class="text-[15px] ml-4">Penilaian</span>
            </a>
            <a href="hitung_aras.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                <i class="fas fa-chart-bar text-lg"></i>
                <span class="text-[15px] ml-4">Metode ARAS</span>
            </a>
            <a href="laporan.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer bg-button-color hover:bg-sky-500 text-white">
                <i class="fas fa-file text-lg"></i>
                <span class="text-[15px] ml-4">Laporan</span>
            </a>
        </aside>

        <!-- Content -->
        <main class="main w-full">
            <!-- navbar -->
            <div class="navbar w-full flex items-center justify-between shadow-bottom pl-2">
                <?php require "./component/breedcrumb.php" ?>
                <a href="logout.php" class="bg-button-color px-3 py-3 hover:bg-sky-500">Keluar</a>
            </div>

            <!-- title page -->
            <div class="flex items-center px-2 h-14">
                <h1 class="text-2xl line-height">Data Laporan</h1>
            </div>
            <hr class="border-2 border-[rgba(196, 196, 196, 1)] mx-2">

            <div class="mt-5 mb-6 mx-2 p-2 border-2 drop-shadow-md">
                <div class="flex items-center justify-between h-14">
                    <h1 class="text-1xl line-height font-bold">Grafik Penilaian Karyawan</h1>
                </div>
                <hr class="border-2 border-[rgba(196, 196, 196, 1)]">
            </div>
            <div class="mt-5 mb-6 mx-2 p-2 border-2 drop-shadow-md">
                <div class="flex w-full">
                    <div class="flex-auto border-2 p-2 drop-shadow-md w-8/12">
                        <canvas class="" id="myChart"></canvas>
                    </div>
                    <div class="flex-auto mx-2 p-2 border-2 drop-shadow-md">
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
                                $no = 1;
                            ?>
                            <tbody class="bg-white divide-y divide-gray-200">
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
                        <a class="bg-button-color px-3 py-2 hover:bg-sky-500" href="./pdf/index.php">Save</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
<script>
  const ctx = document.getElementById('myChart').getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($nama_alternative)?>,
      datasets: [{
        label: 'Grafik Rangking Karyawan',
        data: <?php echo json_encode($nilai_alternative)?>,
        backgroundColor: 'rgba(98 , 205, 255, 0.2)',
		borderColor: 'rgba(98 , 205, 255, 1)',
		borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

<?php include "./partials/footer.php"; ?>