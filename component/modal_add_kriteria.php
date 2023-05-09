    <!-- Modal add karyawan -->
    <div class="modal-add-karyawan w-full h-screen absolute left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="w-1/3 bg-primary-color rounded-mg shadow-lg p-5">
            <div class="flex justify-between">
                <h1 class="text-center">Tambah Kriteria</h1>
                <i class="fas fa-times-circle cursor-pointer text-red-600 hover:text-red-700" onclick="toggleModalAddKaryawan()"></i>
            </div>
            <form action="<?php $home_url ?>models/insert_kriteria.php" method="POST">
                <div class="grid gap-4 mb-4 mt-4">
                    <div>
                        <?php 
                            $nilaiId++;
                            $idKriteria = $kodeId . sprintf("%03s", $nilaiId);
                        ?>
                        <label for="id_kriteria" class="block mb-2 text-sm font-medium">ID Kriteria</label>
                        <input type="text" id="id_kriteria" name="id_kriteria" value="<?php echo $idKriteria ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" readonly>
                    </div>
                    <div>
                        <label for="nama_kriteria" class="block mb-2 text-sm font-medium">Nama</label>
                        <input type="text" id="nama_kriteria" name="nama_kriteria" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="bobot" class="block mb-2 text-sm font-medium">Bobot</label>
                        <input type="number" step="any" id="bobot" name="bobot" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                    </div>
                </div>
                <button type="submit" name="submit" class="bg-button-color px-3 py-2  hover:bg-sky-500 showModal">Simpan</button>
            </form>
        </div>
    </div>