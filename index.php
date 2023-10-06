<?php
  session_start();
  if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
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
    <script src="js/bootstrap.js"></script>
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
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item align-self-center">
                <a class="nav-link" href="movie-list.php">Movies</a>
              </li>
              <li class="nav-item align-self-center">
                <a class="nav-link" href="admin.php">Add Movies</a>
              </li>
              <li class="nav-item align-self-center">
                <a class="nav-link" href="graphic.php">Graphic</a>
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

    <!-- content -->
    <section>
      <div class="container align-self-center mt-5 pt-3 text-light">
        <?php if(isset($_SESSION['username'])){ ?>
          <p class="display-5 text-center mb-0" style='margin-top:45px;'>Hello <?php echo $_SESSION['username']?></p>
          <p class="text-center">Welcome Back!</p>
        <?php } else { ?>
          <p class="display-5 text-center mb-0">Welcome to Movie Mania!</p>
          <p class="text-center">Please Login first!</p>
        <?php } ?>
      </div>
    </section>
    <!-- end content -->
    
    <!-- moviess -->
    <div class="container">
      <?php
        include 'fetcher.php';
      ?>
    </div>
    <!-- end moviess -->
    
    <!-- script -->
    <script></script>
    <!-- end script -->
  </body>
</html>
