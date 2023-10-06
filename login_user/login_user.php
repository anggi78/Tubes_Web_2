<?php
session_start();
require('../koneksi.php');
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: home.php");
    exit;
}

// ...
if (isset($_POST['submit'])) {
    // Ambil data dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lakukan proses verifikasi login
    // ...

    // Jika verifikasi berhasil, set session email
    $_SESSION['email'] = $email;

    // Redirect ke halaman home
    header("location: home.php");
    exit;
}
// ...


$email      = "";
$password   = "";

if ( isset($_POST['simpan']) ) {
    $email      = strtolower($_POST['email']);
    $password   = $_POST['password'];

    $sql1   = "SELECT * FROM user WHERE email = '$email'";
    $q1     = mysqli_query($conn, $sql1);
    $n1     = mysqli_num_rows($q1);
    
    if ( $n1 == 1 ) {
        $r1     = mysqli_fetch_assoc($q1);
        if (md5($password) == $r1['password']){ 
            $redirectUrl = "home.php?email=" . urlencode($email);
            header("Location: " . $redirectUrl);
        } else {
            echo "<script>alert('Maaf, Password yang anda masukkan tidak sesuai !');</script>";
        }
        echo "<script>alert('Maaf, Email belum terdaftar !');</script>";
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginn.css">
    
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <form action="" method="post">
            <ion-icon name="mail-outline"></ion-icon>
            <label for="email">Email :</label>
            <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" required> <br> <br>

            <ion-icon name="lock-closed-outline"></ion-icon>
            <label for="password">Password :</label>
            <input type="password" name="password" placeholder="Password" id="password" value="<?php echo $password; ?>" required> <br> <br>

            <button type="submit" name="simpan">Login</button>
        </form>

        <h4>Belum punya akun ? <a href="register.php">Register</a></h4>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>