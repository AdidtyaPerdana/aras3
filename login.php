<?php include_once "./partials/header.php"; ?>

<?php 

    include "./config/connection.php";
    include "./config/core.php";

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
     
        $sql = "SELECT * FROM tb_users WHERE username='$username' AND password_user='$password'";
        $result = mysqli_query($mysqli, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['fullname'] = $row['fullname'];
            header("Location: {$home_url}index.php");
        } else {
            echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
        }
    }

?>

<body class="bg-primary-color font-body text-text-color">

    <div class="flex justify-center items-center w-full h-screen text-white">
        <div class="w-96 h-96 p-5 flex justify-center items-center bg-second-color rounded-md">
            <div class="w-full">
                <div class="text-center">
                    <i class="fab fa-dyalog px-2 py-1 mb-4 text-2xl bg-button-color"></i>
                    <h1 class="text-center text-2xl">LOGIN ADMIN</h1>
                </div>
                <form action="" method="POST">
                <div class="grid gap-6 mb-6 mt-6">
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium">Username</label>
                        <input type="text" id="username" name="username" class="bg-second-color border border-button-color text-white text-sm rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium">Password</label>
                        <input type="password" id="password" name="password" class="bg-second-color border border-button-color text-white text-sm rounded-lg focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 block w-full p-2.5" required>
                    </div>
                    </div>
                    <button type="submit" name="submit" class="text-white bg-button-color hover:bg-sky-500 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Login</button>
                </form>
            </div>
        </div>
    </div>

</body>

<?php include_once "./partials/footer.php"; ?>