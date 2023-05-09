<!-- Modal edit karyawan -->
<?php 
    if($_POST['id_kriteria']) {
        include "../config/connection.php";
        include "../config/core.php";

        $id = $_POST['id_kriteria']; //escape string
        
        $sql = "SELECT * FROM tb_kriteria WHERE id_kriteria = '$id'";
        $result = $mysqli->query($sql);
        if($result !== false && $result->num_rows > 0){
            while($row = $result->fetch_row()){
?>
                <form action="<?= $home_url ?>models/update_kriteria.php" method="POST">
                    <div class="grid gap-4 mb-4 mt-4">
                    <div>
                        <label for="id_kriteria" class="block mb-2 text-sm font-medium">ID Kriteria</label>
                        <input type="text" id="id_kriteria" name="id_kriteria" value="<?php echo $row[0] ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" readonly>
                    </div>
                    <div>
                        <label for="nama_kriteria" class="block mb-2 text-sm font-medium">Nama</label>
                        <input type="text" id="nama_kriteria" name="nama_kriteria" value="<?php echo $row[1] ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="bobot" class="block mb-2 text-sm font-medium">Bobot</label>
                        <input type="number" step="any" id="bobot" name="bobot" value="<?php echo $row[2] ?>" class="border-2 border-button-color text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                    </div>
                    </div>
                    <button type="submit" name="submit" class="bg-button-color px-3 py-2  hover:bg-sky-500 showModal">Simpan</button>
                </form>
<?php    
            }
        }

?>
<?php } ?>