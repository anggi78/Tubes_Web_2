<?php
  session_start();
  if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $_SESSION['email'] = $email;
  }
  if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: home.php");
    exit;
  }
// Display the alert message if available
if (isset($_SESSION['message'])) {
    echo '<script>alert("' . $_SESSION['message'] . '");</script>';
    unset($_SESSION['message']); // Clear the message
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
          <a class="nav-link" href="home.php<?= isset($_SESSION['email']) ? "?email=" . $_SESSION['email'] : "" ?>">Home</a>
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
            <a class="nav-link active" aria-current="page" href="user2.php<?= isset($_SESSION['email']) ? "?email=" . $_SESSION['email'] : "" ?>">Ulasan</a>
            </li>
            <li class="nav-item align-self-center">
            <?php 
            if (isset($_SESSION['email'])) { ?>                                
              <a class="nav-link" href="home.php<?= isset($_SESSION['email']) ? "?email=" . $_SESSION['email'] : "" ?>&logout=1"><span>Logout</span></a>
            <?php 
            } else { 
            if (isset($_GET['logout'])) {
              session_destroy();
              unset($_SESSION['email']);
              header("location: home.php");
              exit;
            } else { ?>
            <a class="nav-link" href="login_user.php"><span>Log In</span></a>
            <?php 
             } 
            } 
           ?>
            </li>
        <form action="search.php" method="POST" class="d-flex">
          <input class="form-control me-2" name="textoption" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-danger" name="submit" type="submit" value="Search">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- end navbarr -->

  <!-- ulasan -->
  <div class="container align-self-center mt-5 pt-2 text-light">
  <?php if (isset($_SESSION['email'])) { ?>
        <!-- ulasan -->
        <div class="container align-self-center mt-5 pt-2 text-light">
            <div class="container-fluid mt-5 pt-3 text-white">
                <div class="container">
                    <div class="jumbotron">
                        <h1>Movie Mania -  Beri Ulasan Untuk Website Kami</h1>
                        <!-- Form ulasan -->
                        <form class="" id="myForm" action="user-control.php" method="POST" enctype="multipart/form-data">
                            <!-- Input fields go here -->
                            <input type="text" class="form-control" placeholder="Nama" name="mnama" value="" required><br>
                            <input type="text" class="form-control" placeholder="Email" name="email" value="" required><br>
                            <input type="text" class="form-control" placeholder="Tulis ulasan di sini" name="komentar" style="height: 200px;" value="" required><br>
                            <div class="row">
                                <div class="col">
                                </div>
                            </div> <br><br>
                            <div class="signupbutton text-center">
                                <input type="submit" class="btn btn-danger" name="upload" value="Submit">
                                <input type="button" class="btn btn-danger" onclick="resetForm()" value="Reset">
                            </div>
                        </form>
                        <!-- End form ulasan -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end ulasan -->
    <?php } else { ?>
        <!-- Jika pengguna belum login -->
        <p class="display-5 fw-bold text-center mt-5 mb-0"></p>
        <img src="logo.png" alt="logo Movie Mania" class="mx-auto d-block mt-3" sizes="" srcset="">
        <p class="display-5 fw-bold text-center mt-3">Please Login First, Before Adding A Review!</p>
    <?php } ?>

    <!-- ... -->

    <script>
        function resetForm() {
            document.getElementById("myForm").reset();
        }
    </script>

            
      </div>
    </div>
  <!-- end ulasan -->
</body>
</html>