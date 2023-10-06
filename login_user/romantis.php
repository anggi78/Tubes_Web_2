<?php

require('../koneksi.php');
session_start();
  if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: home.php");
}

echo "<link rel='stylesheet' href='css/app.css' />";
echo "<link rel='stylesheet' href='css/bootstrap.css' />";

// Tentukan jumlah data per halaman
$per_halaman = 3;

// Tentukan halaman saat ini
if (isset($_GET['halaman'])) {
  $halaman = $_GET['halaman'];
} else {
  $halaman = 1;
}

// Tentukan offset data
$offset = ($halaman - 1) * $per_halaman;

// Query untuk menampilkan data dengan pagination
$query_genre = "WHERE genre LIKE '%Romance%'";
$im = "SELECT * FROM movies $query_genre ORDER BY name ASC LIMIT $offset, $per_halaman";
$records = mysqli_query($conn,$im);

// Hitung jumlah halaman
$jumlah_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM movies $query_genre"));
$jumlah_halaman = ceil($jumlah_data / $per_halaman);

echo "<div class='card-group justify-content-center border-0'>";

while($result = mysqli_fetch_assoc($records)) {
  echo "<form action='kategori.php' method='POST'>";
  echo "<div class='card-transparent justify-content-center border-0' style='margin-top:100px;margin-left:10px;margin-right:10px;'>";
  echo "<img src='../uploads/".$result['imgpath']."' height='400' width='300' style='margin-top: 30px;margin-left:30px;margin-right:30px;' />";
  echo "<div class='noob'>";
  echo "<input type='submit' name='submit' class='btn btn-danger' style='display:block;width:300px;padding-bottom:15px;margin-bottom:30px;margin-left:30px;margin-right:20px;' value='".ucwords($result['name'])."' />";
  echo "</div>";
  echo "</div>";
  echo "</form>";
}

echo "</div>";

// Tampilkan pagination
echo "<nav aria-label='Page navigation example'>";
echo "<ul class='pagination justify-content-center'>";

// Tombol "Previous"
if ($halaman > 1) {
  $prev = $halaman - 1;
  echo "<li class='page-item'><a class='page-link' href='?halaman=$prev&genre=action'>Previous</a></li>";
} else {
  echo "<li class='page-item disabled'><a class='page-link' href='#'>Previous</a></li>";
}

for ($i=1; $i<=$jumlah_halaman; $i++) {
  if ($i == $halaman) {
    echo "<li class='page-item active'><a class='page-link' href='?halaman=$i&genre=action'>$i</a></li>";
  } else {
    echo "<li class='page-item'><a class='page-link' href='?halaman=$i&genre=action'>$i</a></li>";
  }
}

// Tombol "Next"
if ($halaman < $jumlah_halaman) {
  $next = $halaman + 1;
  echo "<li class='page-item'><a class='page-link' href='?halaman=$next&genre=action'>Next</a></li>";
} else {
    echo "<li class='page-item disabled'><a class='page-link' href='#'>Next</a></li>";
}

echo "</ul>";
echo "</nav>";

while($result = mysqli_fetch_assoc($records)){
  if(isset($_SESSION['username'])){
    $mname = $result['name'];
    $person = $_SESSION['username'];
    $movieid = $result['mid'];
    $current = $result['viewers'];
    $newcount = $current + 1;
    $newsql = "UPDATE movies SET viewers = '$newcount' WHERE name='$mname' ";
    $updatecount = mysqli_query($conn,$newsql);
  }
    ?>

  <div class='container mt-2 mb-2 pt-3 text-white'>
    <form action="">
      <div class="row">
        <div class="col d-flex justify-content-center text-center">
        <table>
          <tr>
            <td>
              <?php
                echo"<img src='../uploads/".$result['imgpath']."' height='400' width='300' style='margin-top: 30px;margin-left:30px;margin-right:30px;' />";
              ?>
            </td>
          </tr>
          <tr>
            <td>
              <?php
              echo"<br><h1 style='display: inline; color: white;'>".ucwords($result['name'])."</h1>";
              echo"<br><h4 style='display: inline; color: white;' >genre : </h4><h4 style='display: inline; color: white;'>".$result['genre']."</h4>";
              echo"<br><h4 style='display: inline; color: white;' >release year : </h4><h4 style='display: inline; color: white;'>".$result['rdate']."</h4>";
              echo"<br><h4 style='display: inline; color: white;' >views : </h4><h4 style='display: inline; color: white;'>".$result['viewers']."</h4>";
              echo"<br><h4 style='display: inline; color: white;' >sinopsis : </h4><h4 style='display: inline; color: white;'>".$result['sinopsis']."</h4>";
              ?>
            </td>                  
          </tr>
        </table>
        </div>
        <?php
        echo"<div class='ratio ratio-16x9 mt-3 ps-3 pe-3 mb-3'>";
        echo"<iframe class='embed-responsive-item' src='video-uploads/".$result['videopath']."' poster='uploads/".$result['imgpath']."' width='800' height='450' frameborder='0' allowfullscreen ></iframe>";
        echo"</video>";
        echo"</div>";

        echo"<script> console.log('".$result ."')</script>";
        ?>
      </div>
    </form>
  </div>

<?php } 
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
              <a class="nav-link" href="home.php<?= isset($_SESSION['email']) ? "?email=" . $_SESSION['email'] : "" ?>">Home</a>
            </li>
            <li class="nav-item dropdown align-self-center">
            <a class="nav-link dropdown-toggle active" href="#" aria-current="page" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
              <a class="nav-link" href="user2.php">Ulasan</a>
            </li>
        <form action="search.php" method="POST" class="d-flex">
          <input class="form-control me-2" name="textoption" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-danger" name="submit" type="submit" value="Search">Search</button>
        </form>
      </div>
    </div>
  </nav>
</body>
</html>