<!-- Modal edit karyawan -->
<?php 
    if($_POST['id_karyawan']) {
        include "../config/connection.php";
        include "../config/core.php";

        $id = $_POST['id_karyawan']; //escape string
        
        $sql = "SELECT * FROM tb_karyawan WHERE id_karyawan = '$id'";
        $result = $mysqli->query($sql);
        if($result !== false && $result->num_rows > 0){
            while($row = $result->fetch_row()){
?>
                <form action="<?= $home_url ?>models/update_karyawan.php" method="POST">
                    <div class="grid gap-4 mb-4 mt-4">
                        <div class="flex">
                            <div class="flex-auto mr-2">
                                <label for="id_karyawan" class="block mb-2 text-sm font-medium">ID Karyawan</label>
                                <input type="text" id="id_karyawan" name="id_karyawan" value="<?= $row[0] ?>" class="id_karyawan border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" readonly>
                            </div>
                            <div class="flex-auto ml-2">
                                <label for="nama_karyawan" class="block mb-2 text-sm font-medium">Nama</label>
                                <input type="text" id="nama_karyawan" name="nama_karyawan" value="<?= $row[1] ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                            </div>
                        </div>
                        <div>
                            <label for="alamat" class="block mb-2 text-sm font-medium">Alamat</label>
                            <input type="text" id="alamat" name="alamat" value="<?= $row[2] ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                        </div>
                        <div>
                            <label for="tempat_lahir" class="block mb-2 text-sm font-medium">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?= $row[3] ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block mb-2 text-sm font-medium">Tanggal Lahir</label>
                            <input type="text" id="tanggal_lahir" name="tanggal_lahir" value="<?= $row[4] ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                        </div>
                        <div class="flex">
                            <div class="flex-auto mr-2">
                                <label for="jenis_kelamin" class="block mb-2 text-sm font-medium">Jenis Kelamin</label>
                                <input type="text" id="jenis_kelamin" value="<?= $row[5] ?>" name="jenis_kelamin" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                            </div>
                            <div class="flex-auto ml-2">
                                <label for="posisi" class="block mb-2 text-sm font-medium">Posisi</label>
                                <input type="text" id="posisi" name="posisi" value="<?= $row[6] ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="bg-button-color px-3 py-2  hover:bg-sky-500 showModal">Simpan</button>
                </form>
<?php    
            }
        }

?>
<?php } ?>