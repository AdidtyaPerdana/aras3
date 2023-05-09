<?php include "./partials/header.php"; ?>

<?php

    include "./config/connection.php";
    include "./config/core.php";

    if (!isset($_SESSION['username'])) {
        header("Location: {$home_url}login.php");
    }

    // ID karyawan
    $queryId = mysqli_query($mysqli, "SELECT max(id_karyawan) as idTerbesar FROM tb_karyawan");
    $resultId = mysqli_fetch_array($queryId);
    $idKaryawan = $resultId["idTerbesar"];
    $nilaiId = (int) substr($idKaryawan, 3, 3);
    $kodeId = "KRY";

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
            <div class="text-left mt-2 w-4/5 mx-auto" id="submenu">
                <a href="data_karyawan.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-sky-500 bg-button-color text-white">
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
            <a href="laporan.php" class="p-2.5 mt-3 flex items-center px-4 duration-300 cursor-pointer hover:bg-button-color text-white">
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
                <h1 class="text-2xl line-height">Data Karyawan</h1>
            </div>
            <hr class="border-2 border-[rgba(196, 196, 196, 1)] mx-2">

            <div class="mt-5 mb-6 mx-2 p-2 border-2 drop-shadow-md">
                <div class="flex items-center justify-between h-14">
                    <h1 class="text-1xl line-height font-bold">Karyawan</h1>
                    <div class="flex">
                        <div class="relative flex items-center">
                            <i class="fas fa-search absolute ml-3 text-button-color pointer-events-none"></i>
                            <input type="text" class="border border-button-color mr-3 p-2 pl-10 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500" placeholder="Cari Karyawan">
                        </div>
                        <button class="bg-button-color px-3 py-2  hover:bg-sky-500 showModal" onclick="toggleModalAddKaryawan()">Tambah Karyawan</button>
                    </div>
                </div>
                <hr class="border-2 border-[rgba(196, 196, 196, 1)]">
                <table class="min-w-full divide-y divide-gray-200 mt-3 mb-4">
                    <thead class="bg-button-color">
                        <tr>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">No</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">ID Karyawan</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Nama</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Alamat</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Tempat Lahir</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Tanggal Lahir</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Jenis Kelamin</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Posisi</th>
                            <th class="py-3 px-6 text-left font-medium tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Insert data karyawan -->
                        <?php
                        $no = 0;
                        $sql = "SELECT * FROM tb_karyawan";
                        $result = $mysqli->query($sql);
                        if ($result !== false && $result->num_rows > 0) {
                            while ($row = $result->fetch_row()) {
                        ?>
                                <tr>
                                    <td class="py-3 px-6"><?php echo $no = $no + 1; ?></td>
                                    <td class="py-3 px-6"><?= $row[0] ?></td>
                                    <td class="py-3 px-6"><?= $row[1] ?></td>
                                    <td class="py-3 px-6"><?= $row[2] ?></td>
                                    <td class="py-3 px-6"><?= $row[3] ?></td>
                                    <td class="py-3 px-6"><?= $row[4] ?></td>
                                    <td class="py-3 px-6"><?= $row[5] ?></td>
                                    <td class="py-3 px-6"><?= $row[6] ?></td>
                                    <td class="py-3 px-6">
                                        <div class="flex">
                                            <a class="py-0.5 px-2 border-solid border-2 border-white bg-red-600 hover:bg-red-700 confirmation-delete" href="models/delete_karyawan.php?id=<?= $row[0] ?>">
                                                <i class="fas fa-times-circle text-white"></i>
                                            </a>
                                            <a class="btn-edit-karyawan py-0.5 px-2 border-solid border-2 border-white bg-green-500 hover:bg-green-600 cursor-pointer" data-id="<?= $row[0] ?>">
                                                <i class="fas fa-pen-square text-white"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal add karyawan -->
    <?php require "./component/modal_add_karyawan.php" ?>

    <!-- Modal edit karyawan -->
    <div class="modal-edit-karyawan w-full h-screen absolute left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="w-1/3 bg-primary-color rounded-mg shadow-lg p-5">
            <div class="flex justify-between">
                <h1 class="text-center">Edit Karyawan</h1>
                <i class="fas fa-times-circle cursor-pointer text-red-600 hover:text-red-700" onclick="closeModalEditKaryawan()"></i>
            </div>
            <div class="form-edit"></div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

<?php include "./partials/footer.php"; ?>