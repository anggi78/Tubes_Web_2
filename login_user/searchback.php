<?php
require('../koneksi.php');
echo"<link rel='stylesheet' href='css/app.css' />";
echo"<link rel='stylesheet' href='css/bootstrap.css' />";
if(isset($_POST['submit'])){

    $text =  strtolower($_POST['textoption']);

    $found = "SELECT * FROM movies WHERE name LIKE '$text%'";
    $display = mysqli_query($conn,$found);

  start:
  $i=0;

  echo"<div class='card-group justify-content-center border-0'>";
    while($final = mysqli_fetch_assoc($display)){
      echo"<form action='movie.php' method='POST'>";
      echo"<div class='card-transparent  justify-content-center border-0' >";
      echo "<img src='../uploads/".$final['imgpath']."' height='450' width='300' style='margin-top: 30px;margin-left:30px;margin-right:30px;' />";
        echo"<div class='noob'>";
          echo "<input type='submit' name='submit' class='btn btn-danger' style='display:block;width:300px;padding-bottom:15px;margin-bottom:30px;margin-left:30px;margin-right:20px;' value='".ucwords($final['name'])."'/>";
        echo"</div>";
      echo"</div>";
      echo"</form>";

      if ($i==7) {

        echo"</div>";

        goto start;
      }
      $i++;
    }
  }


 ?>