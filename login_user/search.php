<?php
session_start();
  if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: home.php");
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
      <a class="navbar-brand" href="home.php">
        <i class="bx bx-movie-play bx-tada main-color"></i>
        <img src="logo.png" alt="" width="200px" height="60">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item align-self-center">
              <a class="nav-link" aria-current="page" href="home.php<?= isset($_SESSION['email']) ? "?email=" . $_SESSION['email'] : "" ?>">Home</a>
            </li>
            <li class="nav-item dropdown align-self-center">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Genre
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="action.php">Action</a></li>
              <li><a class="dropdown-item" href="comedy.php">Comedy</a></li>
              <li><a class="dropdown-item" href="romantis.php">Romance</a></li>
              <li><a class="dropdown-item" href="thriller.php">Thriller</a></li>
              <li><a class="dropdown-item" href="horror.php">Horror</a></li>
            </ul>
          </li>
            <li class="nav-item align-self-center">
              <a class="nav-link" aria-current="page" href="user2.php">Ulasan</a>
            </li>
        <form action="search.php" method="POST" class="d-flex">
          <input class="form-control me-2" name="textoption" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-danger" name="submit" type="submit" value="Search" onclick="goBack()">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- end navbarr -->

    <!-- Result -->
    <div class="container mt-6 pt-3 text-white" style='margin-top:100px;'>
      <h2 style='margin-top:0px;padding-top:0px;'>Results : </h2>
        <?php
        include 'searchback.php';
        ?>
    </div>
    <!-- End Result -->


  </section>
  </body>
  <script>
  // Mengatur ulang cache saat halaman dimuat
  window.onload = function() {
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  };

  // Menangani klik tombol kembali ke halaman lain
  function goBack() {
    window.history.pushState(null, null, "home.php"); // Ganti "halaman_lain.php" dengan halaman tujuan Anda
  }
</script>
</html>