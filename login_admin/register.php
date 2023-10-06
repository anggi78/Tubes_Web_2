<?php
//menyertakan file program koneksi.php pada register
require('../koneksi.php');
//inisialisasi session
session_start();
 
$error = '';
$validate = '';
//mengecek apakah form registrasi di submit atau tidak
if( isset($_POST['submit']) ){
        // menghilangkan backshlases
        $username = stripslashes($_POST['username']);
        //cara sederhana mengamankan dari sql injection
        $username = mysqli_real_escape_string($conn, $username);
        $name     = stripslashes($_POST['name']);
        $name     = mysqli_real_escape_string($conn, $name);
        $email    = stripslashes($_POST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $repass   = stripslashes($_POST['repassword']);
        $repass   = mysqli_real_escape_string($conn, $repass);
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if(!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))){
            //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali
            if($password == $repass){
                //memanggil method cek_username untuk mengecek apakah nama sudah terdaftar atau belum
                if( cek_nama($name,$conn) == 0 ){
                    //memanggil method cek_nama untuk mengecek apakah email sudah terdaftar atau belum
                    if( cek_email($email,$conn) == 0){
                        //memanggil method cek_email untuk mengecek apakah username sudah terdaftar atau belum
                        if( cek_username($username,$conn) == 0){
                            //hashing password sebelum disimpan didatabase
                            $pass  = password_hash($password, PASSWORD_DEFAULT);
                            //insert data ke database
                            $query = "INSERT INTO users (username,name,email, password ) VALUES ('$username','$name','$email','$pass')";
                            $result   = mysqli_query($conn, $query);
                            //jika insert data berhasil maka akan diredirect ke halaman index.php serta menyimpan data username ke session
                            if ($result) {
                                $_SESSION['username'] = $username;
                                
                                header('Location: ../login_admin/login.php');
                            
                            //jika gagal maka akan menampilkan pesan error
                            } else {
                                $error =  'Register User Gagal !';
                            }
                        }else{
                            $error =  'Username sudah terdaftar !';
                        }
                    }else{
                        $error =  'Email sudah terdaftar !';
                    }
                }else{
                        $error =  'Nama sudah terdaftar !';
                }
            }else{
                $validate = 'Password tidak sama !';
            }
             
        }else {
            $error =  'Data tidak boleh kosong !';
        }
    } 
    //fungsi untuk mengecek username apakah sudah terdaftar atau belum
    function cek_username($username,$conn){
        $username = mysqli_real_escape_string($conn, $username);
        $query = "SELECT * FROM users WHERE username = '$username'";
        if( $result = mysqli_query($conn, $query) ) return mysqli_num_rows($result);
    }
    //fungsi untuk mengecek nama apakah sudah terdaftar atau belum
    function cek_nama($name,$conn){
        $name = mysqli_real_escape_string($conn, $name);
        $query = "SELECT * FROM users WHERE name = '$name'";
        if( $result = mysqli_query($conn, $query) ) return mysqli_num_rows($result);
    }
    //fungsi untuk mengecek email apakah sudah terdaftar atau belum
    function cek_email($email,$conn){
        $email = mysqli_real_escape_string($conn, $email);
        $query = "SELECT * FROM users WHERE email = '$email'";
        if( $result = mysqli_query($conn, $query) ) return mysqli_num_rows($result);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NexFlit-Login</title>
    
    <!-- Logo -->
    <link type="image/x-icon" href="logo.png" rel="shortcut icon">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <style type="text/css">
    body { background: url(bg_login) !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
    </style>
    <link rel="stylesheet" href="../css/app.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <!-- JS -->
    <script src="../js/bootstrap.js"></script>
</head>
<body>
    <!-- navbarr -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="../index.php">
          <i class="bx bx-movie-play bx-tada main-color"></i>
          <img src="logo.png" alt="" width="60" height="15">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item align-self-center">
                <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                </li>
            </ul>
        </div>
      </div>
    </nav>
    <!-- end navbarr -->
    <!-- form register -->
    <section class="container-fluid mt-5 pt-3 mb-4 text-white">
        <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
        <section class="row justify-content-center">
        <section class="col-12 col-sm-6 col-md-4">
            <form class="form-container" action="register.php" method="POST">
                <a href="../index.php">
                    <img src="../img/logo.png" class="mx-auto d-block mt-3 mb-2" width="100px" alt="">
                </a>
                <h2 class="text-center font-weight-bold pb-2 "> Sign-Up </h2>
                <?php if($error != ''){ ?>
                    <div class="alert alert-danger fw-bold text-center" role="alert"><?= $error; ?></div>
                <?php } ?>
                
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                    <label for="InputEmail">Alamat Email</label>
                    <input type="email" class="form-control" id="InputEmail" name="email" aria-describeby="emailHelp" placeholder="Masukkan email">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                </div>
                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Masukkan Password">
                    <?php if($validate != '') {?>
                        <p class="text-danger"><?= $validate; ?></p>
                    <?php }?>
                </div>
                <div class="form-group">
                    <label for="InputPassword">Re-Password</label>
                    <input type="password" class="form-control" id="InputRePassword" name="repassword" placeholder="Masukkan Ulang Password">
                    <?php if($validate != '') {?>
                        <p class="text-danger"><?= $validate; ?></p>
                    <?php }?>
                </div>
                <button class="btn btn-danger mt-3 mx-auto d-block col-12" type="submit" name="submit">Register</button>
                <div class="form-footer text-center mt-2">
                <p> Sudah punya account? <br><a href="login.php" class="text-danger" style="text-decoration:none;">Login</a></p>
                </div>
            </form>
        </section>
        </section>
    </section>
    <!-- end form register -->
 
    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>