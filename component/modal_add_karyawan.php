<!-- Modal add karyawan -->
<div class="modal-add-karyawan w-full h-screen absolute left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden text-sm">
    <div class="w-1/3 bg-primary-color rounded-mg shadow-lg p-5">
        <div class="flex justify-between">
            <h1 class="text-center">Tambah Karyawan</h1>
            <i class="fas fa-times-circle cursor-pointer text-red-600 hover:text-red-700" onclick="toggleModalAddKaryawan()"></i>
        </div>
        <form action="<?php $home_url ?>models/insert_karyawan.php" method="POST">
            <div class="grid gap-4 mb-4 mt-4">
                <div class="flex">
                    <div class="flex-auto mr-2">
                        <?php 
                            $nilaiId++;
                            $idKaryawan = $kodeId . sprintf("%03s", $nilaiId);
                        ?>
                        <label for="id_karyawan" class="block mb-2 text-sm font-medium">ID Karyawan</label>
                        <input type="text" id="id_karyawan" name="id_karyawan" value="<?php echo $idKaryawan ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" readonly>
                    </div>
                    <div class="flex-auto ml-2">
                        <label for="nama_karyawan" class="block mb-2 text-sm font-medium">Nama</label>
                        <input type="text" id="nama_karyawan" name="nama_karyawan" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                    </div>
                </div>
                <div>
                    <label for="alamat" class="block mb-2 text-sm font-medium">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="tempat_lahir" class="block mb-2 text-sm font-medium">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                </div>
                <div class="flex">
                    <div class="flex-auto mr-2">
                        <label for="jenis_kelamin" class="block mb-2 text-sm font-medium">Jenis Kelamin</label>
                        <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                    </div>
                    <div class="flex-auto ml-2">
                        <label for="posisi" class="block mb-2 text-sm font-medium">Posisi</label>
                        <input type="text" id="posisi" name="posisi" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="bg-button-color px-3 py-2  hover:bg-sky-500 showModal">Simpan</button>
        </form>
    </div>
</div>