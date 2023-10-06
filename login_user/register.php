<?php
require('../koneksi.php');
$email         = "";
$nama_lengkap  = "";

if (isset($_POST['simpan'])) {
    $nama_lengkap         = htmlspecialchars(ucwords($_POST['nama_lengkap']));
    $email                = htmlspecialchars(strtolower($_POST['email']));
    $password             = htmlspecialchars($_POST['password']);
    $konfirmasi_password  = htmlspecialchars($_POST['c_pass']);

    if ($password != $konfirmasi_password) {
        echo "<script>alert('Password yang Anda masukkan tidak sesuai.');</script>";
    } else {
        if ($password == $konfirmasi_password) {
            $sql1 = "insert into user(nama_lengkap, email, password) values ('$nama_lengkap','$email',md5('$password'))";
            $q1 = mysqli_query($conn, $sql1);
            if ($q1) {
                echo "<script>alert('Akun berhasil terdaftar.');</script>";

                $email         = "";
                $nama_lengkap  = "";
            } else {
                echo "<script>alert('Akun gagal terdaftar.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="regiss.css">
</head>
<body>
<div class="container">
    <h1> Registrasi </h1>

    <form action="" method="post">
    <div class="bungkus">
        <ion-icon name="person-outline"></ion-icon>
        <label for ="nama_lengkap">Nama Lengkap : </lable>
    </div>
    <input type ="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama lengkap" value="<?php echo $nama_lengkap; ?>" required> <br><br>
    <div class="bungkus">
        <ion-icon name="mail-outline"></ion-icon>
        <label for ="email">Alamat E-Mail : </lable>
    </div>  
    <input type ="text" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" required> <br><br>
    <div class="bungkus">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <label for ="password">Password : </lable>
    </div>
    <input type ="password" name="password" id="password" placeholder="Password" value="" required> <br><br>
    <div class="bungkus">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <label for ="c_pass">Konfirmasi Password : </lable>
    </div>
    <input type ="password" name="c_pass" id="c_pass" placeholder="Konfirmasi password" value="" required> <br><br>
    <button type ="submit" name="simpan">Daftar Akun Sekarang</button>
    </form>

    <h4>Sudah punya akun ? Silahkan Login <a href ="login_user.php">Di Sini</a></h4>
</div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>