<?php
session_start();
if(isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: index.php");
}
include('koneksi.php');
$data_barang = mysqli_query($conn,"SELECT name FROM movies GROUP BY name");
$penjualan = mysqli_query($conn,"SELECT SUM(viewers) AS sold FROM movies GROUP BY name");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Movie Mania-Graphics</title>
    
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
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- box icons -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <!-- JS -->
    <script src="assets/Chart.js" type="text/javascript"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>         
  </head>
  <body>
    <!-- navbarr -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top transparent" style="backdrop-filter: blur(0px);">
      <div class="container">
        <a class="navbar-brand" href="index.php">
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
                <a class="nav-link" href="admin.php">Add Movies</a>
              </li>
              <li class="nav-item align-self-center">
                <a class="nav-link active" aria-current="page href="graphic.php">Graphic</a>
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

    <!-- Grafik -->
    <section>
      <div class="display-5 text-center text-white mt-5 pt-3">Movie Mania Graph</div>
      <center>
        <canvas id="movies"></canvas>
      </center>
      <div class="container text-white">
        <script>
        var ctx = document.getElementById("movies").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php while($row = mysqli_fetch_array($data_barang)) {echo '"'.$row['name']. '",';}?>],
                datasets: 
                [
                    {
                        label: 'Jumlah Penonton',
                        data: [<?php while($row = mysqli_fetch_array($penjualan)) {echo '"'.$row['sold']. '",';}?>],
                        backgroundColor: ["#FBF46D","#B4FE98","#C5A3FF","#FF9CEE","#77E4D4","#B5B9FF","#FFABAB","#97A2FF","#F6A6FF","#97A2FF","#F6A6FF","#6EB5FF","#FFABAB","#B28DFF"],
                        borderWidth: 1
                    }
                ]
            },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
                }
            }
        });
        </script>
      </div>
    </section>
    <!-- End Grafik -->
  </body>
</html>