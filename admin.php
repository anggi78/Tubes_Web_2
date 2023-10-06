<?php
  session_start();
  if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
  }

  // Fungsi validasi
function validate_input($input) {
  if (empty($input)) {
      return false;
  }
  return true;
}

// Validasi form saat submit
if (isset($_POST['upload'])) {
  $mname = $_POST['mname'];
  $release = $_POST['release'];
  $genre = $_POST['genre'];
  $sinopsis = $_POST['sinopsis'];
  
  // Validasi mname
  if (!validate_input($mname)) {
      echo "Nama Film harus diisi.<br>";
      // Jika ada error, bisa dihandle sesuai kebutuhan, seperti menampilkan pesan kesalahan atau menghentikan proses selanjutnya.
  }
  
  // Validasi release
  if (!validate_input($release)) {
      echo "Tahun Rilis harus diisi.<br>";
      // Jika ada error, bisa dihandle sesuai kebutuhan, seperti menampilkan pesan kesalahan atau menghentikan proses selanjutnya.
  }
  
  // Validasi genre
  if (!validate_input($genre) || $genre == "-- Pilih Genre --") {
      echo "Genre harus dipilih.<br>";
      // Jika ada error, bisa dihandle sesuai kebutuhan, seperti menampilkan pesan kesalahan atau menghentikan proses selanjutnya.
  }
  
  // Validasi sinopsis
  if (!validate_input($sinopsis)) {
      echo "Sinopsis harus diisi.<br>";
      // Jika ada error, bisa dihandle sesuai kebutuhan, seperti menampilkan pesan kesalahan atau menghentikan proses selanjutnya.
  }
  
  // Proses upload jika tidak ada error
  if (validate_input($mname) && validate_input($release) && validate_input($genre) && validate_input($sinopsis)) {
      // Lakukan proses upload file
      // ...
  }
}
?>

<!DOCTYPE html>
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
  body { background: #181616 !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
  </style>
  <link rel="stylesheet" href="css/app.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- box icons -->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
  <!-- navbarr -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top transparent" style="backdrop-filter: blur(0px);">
    <div class="container">
      <a class="navbar-brand" href="#">
        <i class="bx bx-movie-play bx-tada main-color"></i>
        <img src="logo.png" alt="" width="200px" height="60">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item align-self-center">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item align-self-center">
              <a class="nav-link" href="movie-list.php">Movies</a>
            </li>
            <li class="nav-item align-self-center">
              <a class="nav-link active" aria-current="page" href="admin.php">Add movies</a>
            </li>
            <li class="nav-item align-self-center">
              <a class="nav-link" href="graphic.php">Graphic</a>
            </li>
            </li>
              <li class="nav-item align-self-center">
                <a class="nav-link" href="pengguna.php">Pengguna</a>
              </li>
              <li class="nav-item align-self-center">
                <a class="nav-link" href="ulasan.php">Ulasan</a>
              </li>
            <li class="nav-item align-self-center">
              <?php if(isset($_SESSION['username'])){ ?>                                
                  <a class="nav-link" href="index.php?logout='1'"><span>Logout</span></a>
                    <?php } else if(isset($_GET['logout'])){ 
                    header("location: index.php"); ?>
                    <?php } else { ?>
                  <a class="nav-link" href="login_admin/login.php"><span>Log In</span></a>
              <?php } ?>
            </li>
        </ul>
        <form action="search.php" method="POST" class="d-flex">
          <input class="form-control me-2" name="textoption" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-danger" name="submit" type="submit" value="Search">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- end navbarr -->

  <!-- add movies -->
  <div class="container align-self-center mt-5 pt-2 text-light">
    <?php if(isset($_SESSION['username'])){ ?>                    
  <div class="container-fluid mt-5 pt-3 text-white">
    <div class="container">
      <div class="jumbotron">
        <h1>Movie Mania -  Upload Movie</h1>
          <form class="" action="admin-control.php" method="POST" enctype="multipart/form-data">
            <input type="text" class="form-control" placeholder="Movie Name" name="mname" value="" required><br>
            <input type="text" class="form-control" placeholder="Year of Release" name="release" value="" required><br>
            <select name="genre" class="form-select" aria-label="Default select example" required>
            <option value selected>-- Pilih Genre --</option>
            <option value="Action">Action</option>
            <option value="Comedy">Comedy</option>
            <option value="Romance">Romance</option>
            <option value="Thriller">Thriller</option>
            <option value="Horror">Horror</option>
            </select><br>
            <input type="text" class="form-control" placeholder="Sinopsis" name="sinopsis" value="" required><br><br>
            <div class="row">
              <div class="col">
                <table>
                  <tr>
                    <td> <label for=""><b>Upload Image : </b></label> </td>
                  </tr>
                  <tr>
                    <td>
                        <div class="">
                          <input type="hidden" name="size" value="100000">
                          <input type="file" name="image" value="" required>
                        </div>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col mt-2">
                <table>
                  <tr>
                    <td> <label for=""><b>Upload Video : </b></label> </td>
                  </tr>
                  <tr>
                    <td>
                        <div class="">
                            <input type="hidden" name="size" value="30000000">

                            <input type="file" name="video" value="" required>
                        </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div> <br><br>
            <div class="signupbutton">
              <input type="submit"  class ="btn btn-danger" name="upload" value="Submit" onclick="showAlert()">
            </div>
          </form>
          <script>
            function showAlert() {
              var movieName = document.querySelector('input[name="mname"]').value;
              var releaseYear = document.querySelector('input[name="release"]').value;
              var genre = document.querySelector('select[name="genre"]').value;
              var sinopsis = document.querySelector('input[name="sinopsis"]').value;
              var imageFile = document.querySelector('input[name="image"]').value;
              var videoFile = document.querySelector('input[name="video"]').value;

              if (movieName === '' || releaseYear === '' || genre === '-- Pilih Genre --' || sinopsis === '' || imageFile === '' || videoFile === '') {
                return; // Jika ada input yang kosong, keluar dari fungsi showAlert()
              }

              // Jika semua input telah diisi, tampilkan pesan alert
              alert("Film berhasil diupload!");
            }   
          </script>
      </div>
    </div>
  </div>
    <?php } else { ?>      
      <p class="display-5 fw-bold text-center mt-5 mb-0">Only admin that can access this page</p>
      <img src="logo.png" alt="logo Movie Mania" class="mx-auto d-block mt-3" sizes="" srcset="">
      <p class="display-5 fw-bold text-center mt-3">Please Login first!</p>
    <?php } ?>
  </div>
  <!-- end add movies -->
</body>
</html>