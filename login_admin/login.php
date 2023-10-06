<?php
//menyertakan file program koneksi.php pada register
require('../koneksi.php');
//inisialisasi session
session_start();
 
$error = '';
$validate = '';
 
//mengecek apakah sesssion username tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if( isset($_SESSION['username']) ) header('Location: ../index.php');
 
//mengecek apakah form disubmit atau tidak
if( isset($_POST['submit']) ){
         
        // menghilangkan backshlases
        $username = stripslashes($_POST['username']);
        //cara sederhana mengamankan dari sql injection
        $username = mysqli_real_escape_string($conn, $username);
         // menghilangkan backshlases
        $password = stripslashes($_POST['password']);
         //cara sederhana mengamankan dari sql injection
        $password = mysqli_real_escape_string($conn, $password);
        
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if(!empty(trim($username)) && !empty(trim($password))){
            
            //select data berdasarkan username dari database
            $query      = "SELECT * FROM users WHERE username = '$username' OR email = '$username' OR name = '$username'";
            $result     = mysqli_query($conn, $query);
            $rows       = mysqli_num_rows($result);
 
            if ($rows != 0) {
                $hash   = mysqli_fetch_assoc($result)['password'];
                if(password_verify($password, $hash)){
                    $_SESSION['username'] = $username;                      
                    header('Location: ../index.php');
                }else{
                    $error =  'Password salah !!';
                }
                             
            //jika gagal maka akan menampilkan pesan error
            } else {
                $error =  'Username tidak ditemukan !!';
            }
             
        }else {
            $error =  'Data tidak boleh kosong !!';
        }
    } 
 
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Movie Mania-Beyond Your Expectations</title>
    
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
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top transparent" style="backdrop-filter: blur(0px);">
      <div class="container">
        <a class="navbar-brand" href="../index.php">
          <i class="bx bx-movie-play bx-tada main-color"></i>
          <img src="logo.png" alt="" width="200px" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item align-self-center">
                <a class="nav-link text-white" style="color: #8B0000;" aria-current="page" href="../index.php">Home</a>
                </li>
            </ul>
        </div>
      </div>
    </nav>
    <!-- end navbarr -->
    <!-- form login -->
    <section class="container mt-6 pt-5 mb-4 text-white">
        <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
        <section class="row  justify-content-center">
        <section class="col-12 col-sm-6 col-md-4">
            <form class="form-container" action="login.php" method="POST">
                <a href="../index.php">
                    <img src="logo.png" class="mx-auto d-block mt-4 mb-3" width="300px" alt="">
                </a>
                <h2 class="text-center font-weight-bold pb-3 text-danger">SIGN-IN</h2>
                <?php if($error != ''){ ?>
                    <div class="alert alert-danger fw-bold text-center" role="alert"><?= $error; ?></div>
                <?php } ?>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" autocomplete="off" class="form-control" id="username" name="username" placeholder="Masukkan username">
                </div>
                <div class="form-group">
                    <label for="InputPassword" class="center-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Masukkan Password">
                    <?php if($validate != '') {?>
                        <p class="text-danger"><?= $validate; ?></p>
                    <?php }?>
                </div>   
                <button class="btn btn-danger mt-3 mx-auto d-block col-3" type="submit" name="submit">Sign In</button>
                </div>
            </form>
        </section>
        </section>
    </section>
    <!-- end form login -->
 
    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>