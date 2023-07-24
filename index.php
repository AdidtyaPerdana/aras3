
<?php include_once "./partials/header.php"; ?>

<?php 

    include "./config/connection.php";
    include "./config/core.php";

    if (!isset($_SESSION['username'])) {
        header("Location: {$home_url}login.php");
    }

    // Data karyawan
    $sql = "SELECT COUNT(*) FROM tb_karyawan";
    $result = mysqli_query($mysqli, $sql);
    $totalKaryawan = $result->fetch_array();

    // Data kriteria
    $sql = "SELECT COUNT(*) FROM tb_kriteria";
    $result = mysqli_query($mysqli, $sql);
    $totalKriteria = $result->fetch_array();

    // Data user
    $sql = "SELECT COUNT(*) FROM tb_users";
    $result = mysqli_query($mysqli, $sql);
    $totalUser = $result->fetch_array();

?>

<body class="bg-primary-color font-body text-text-color">

    <div class="flex">
        <!-- sidebar -->
        <aside class="sidebar h-screen sticky top-0 p-2 overflow-y-auto text-center bg-second-color" style="width: 320px;">
            <div class="text-gray-100 text-xl">
                <div class="p-2.5 mt-1 flex items-center">
                    <i class="fab fa-dyalog px-2 py-1 bg-button-color"></i>
                    <h1 class="font-bold text-gray-200 text-[15px] ml-3">SPK Kinerja Karyawan</h1>
                </div>
                <hr class="my-2 border-1 border-[rgba(196, 196, 196, 1)]">
            </div>
            <div class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
                <div class="flex justify-between items-center">
                    <i class="fas fa-user-circle text-lg"></i>
                    <div class=" ml-4 text-left">
                        <p class="text-[15px]">Thoriq Wajedi</p>
                        <p class="font-thin text-[12px]">Admin</p>
                    </div>
                </div>
            </div>
            <hr class="my-2 border-1 border-[rgba(196, 196, 196, 1)]">
            <a href="index.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer bg-button-color hover:bg-sky-500 text-white">
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
            <a href="hitung_aras.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
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
                <a class="navbar-brand tanggal-navbar"></a>
                <a href="logout.php" class="bg-button-color px-3 py-3 hover:bg-sky-500">Keluar</a>
            </div>

            <!-- title page -->
            <div class="flex items-center px-2 h-14">
                <h1 class="text-2xl line-height">Beranda</h1>
            </div>
            <hr class="border-2 border-[rgba(196, 196, 196, 1)] mx-2">

            <div class="flex flex-col items-center justify-center h-4/5 px-2">
                <p class="font-light">Selamat datang di</p>
                <h1 class="text-4xl w-9/12 text-center font-bold">SISTEM PEMBANTU KEPUTUSAN MENENTUKAN KINERJA KARYAWAN</h1>
                <div class="flex flex-wrap justify-center">
                    <div class="mx-9 bg-second-color mt-5" style="width: 256px;">
                        <div class="p-5">
                            <div class="text-white">
                                <div class="flex items-center">
                                    <i class="fas fa-users text-8xl mr-3 text-button-color"></i>
                                    <div class="flex justify-center w-full">
                                        <h2 class="font-bold text-7xl"><?= $totalKaryawan[0]; ?></h2>
                                    </div>
                                </div>
                                <p class="mt-3 text-2xl">Data Karyawan</p>
                            </div>
                        </div>
                    </div>
                    <div class="mx-9 bg-second-color mt-5" style="width: 256px;">
                        <div class="p-4">
                            <div class="text-white">
                                <div class="flex items-center">
                                    <i class="fas fa-list-alt text-8xl mr-3 text-button-color"></i>
                                    <div class="flex justify-center w-full">
                                        <h2 class="font-bold text-7xl"><?= $totalKriteria[0] ?></h2>
                                    </div>
                                </div>
                                <p class="mt-3 text-2xl">Kriteria</p>
                            </div>
                        </div>
                    </div>
                    <div class="mx-9 bg-second-color mt-5" style="width: 256px;">
                        <div class="p-4">
                            <div class="text-white">
                                <div class="flex items-center">
                                    <i class="fas fa-user text-8xl text-button-color"></i>
                                    <div class="flex justify-center w-full">
                                        <h2 class="font-bold text-7xl"><?= $totalUser[0] ?></h2>
                                    </div>
                                </div>
                                <p class="mt-3 text-2xl">Pengguna</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

<?php include_once "./partials/footer.php"; ?>