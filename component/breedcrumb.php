<nav class="flex ml-2" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <?php 
      switch (basename($_SERVER["PHP_SELF"])) {
        case "index.php":
          echo '<li class="inline-flex  items-center">
                  <a href="index.php" class="inline-flex items-center text-sm font-medium">
                  <i class="fas fa-home text-lg mr-2 text-button-color"></i>
                   Home
                  </a>
                </li>';
          break;
        case "data_kriteria.php":
          echo '<div class="flex">
                  <li class="inline-flex items-center">
                    <a href="index.php" class="inline-flex items-center text-sm font-medium">
                      <i class="fas fa-home text-lg mr-2 text-button-color"></i>
                      Home
                    </a>
                  </li>
                  <li>
                    <div class="flex items-center">
                      <i class="fas fa-arrow-right text-lg mr-3 ml-3 text-gray-color"></i>
                      <a href="#" class="ml-1 text-sm font-medium md:ml-2">
                        Data Master
                      </a>
                    </div>
                  </li>
                  <li aria-current="page">
                    <div class="flex items-center">
                      <i class="fas fa-arrow-right text-lg mr-3 ml-3 text-gray-color"></i>
                      <a href="data_kriteria.php" class="ml-1 text-sm font-medium md:ml-2">
                        Data kriteria
                      </a>
                    </div>
                  </li>
                </div>';
          break;
        case "data_karyawan.php":
          echo '<div class="flex">
                  <li class="inline-flex items-center">
                    <a href="index.php" class="inline-flex items-center text-sm font-medium">
                      <i class="fas fa-home text-lg mr-2 text-second-color"></i>
                      Home
                    </a>
                  </li>
                  <li>
                    <div class="flex items-center">
                      <i class="fas fa-arrow-right text-lg mr-3 ml-3 text-gray-color"></i>
                      <a href="#" class="ml-1 text-sm font-medium md:ml-2">
                        Data Master
                      </a>
                    </div>
                  </li>
                  <li aria-current="page">
                    <div class="flex items-center">
                      <i class="fas fa-arrow-right text-lg mr-3 ml-3 text-gray-color"></i>
                      <a href="data_karyawan.php" class="ml-1 text-sm font-medium md:ml-2">
                        Data karyawan
                      </a>
                    </div>
                  </li>
                </div>';
          break;
          case "data_penilaian.php":
            echo '<div class="flex">
                    <li class="inline-flex items-center">
                      <a href="index.php" class="inline-flex items-center text-sm font-medium">
                        <i class="fas fa-home text-lg mr-2 text-second-color"></i>
                        Home
                      </a>
                    </li>
                    <li>
                      <div class="flex items-center">
                        <i class="fas fa-arrow-right text-lg mr-3 ml-3 text-gray-color"></i>
                        <a href="data_penilaian" class="ml-1 text-sm font-medium md:ml-2">
                          Data Penilaian
                        </a>
                      </div>
                    </li>
                  </div>';
            break;
          case "hitung_aras.php":
            echo '<div class="flex">
                    <li class="inline-flex items-center">
                      <a href="index.php" class="inline-flex items-center text-sm font-medium">
                        <i class="fas fa-home text-lg mr-2 text-second-color"></i>
                        Home
                      </a>
                    </li>
                    <li>
                      <div class="flex items-center">
                        <i class="fas fa-arrow-right text-lg mr-3 ml-3 text-gray-color"></i>
                        <a href="hitung_aras.php" class="ml-1 text-sm font-medium md:ml-2">
                          Hitung ARAS
                        </a>
                      </div>
                    </li>
                  </div>';
            break;
            case "laporan.php":
              echo '<div class="flex">
                      <li class="inline-flex items-center">
                        <a href="index.php" class="inline-flex items-center text-sm font-medium">
                          <i class="fas fa-home text-lg mr-2 text-second-color"></i>
                          Home
                        </a>
                      </li>
                      <li>
                        <div class="flex items-center">
                          <i class="fas fa-arrow-right text-lg mr-3 ml-3 text-gray-color"></i>
                          <a href="hitung_aras.php" class="ml-1 text-sm font-medium md:ml-2">
                            Laporan
                          </a>
                        </div>
                      </li>
                    </div>';
              break;
        default:
          echo "Your favorite color is neither red, blue, nor green!";
      }
    ?>
  </ol>
</nav>