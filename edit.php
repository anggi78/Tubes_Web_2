<?php
if(isset($_POST['submit'])){
   include "koneksi.php";
   $kode = $_POST['kode'];
   $name = $_POST['name'];
   $rdate = $_POST['rdate'];
   $genre = $_POST['genre'];
   $sinopsis = $_POST['sinopsis'];
   $sql = "UPDATE movies SET name='$name', rdate='$rdate', genre='$genre', sinopsis='$sinopsis' WHERE name='$kode'";
   $kueri = mysqli_query($conn, $sql);
   if($kueri){
       //jika berhasil diedit
       echo "<script>alert('Film berhasil diedit');document.location='movie-list.php'</script>";
   } else{
       //jika gagal diedit
       echo "<script>alert('Film gagal diedit');document.location='movie-list.php'</script>";
   }
} elseif(isset($_GET['kode'])) {
   // menampilkan form edit
   include "koneksi.php";
   $kode = $_GET['kode'];
   $sql = "SELECT * FROM movies WHERE name='$kode'";
   $kueri = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($kueri);
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
<div class="container-fluid mt-5 pt-3 text-white">
    <div class="container">
      <div class="jumbotron">
    <div class="container">
         <h1>Movie Mania -  Edit Movie</h1>
        <form method="POST" action="">
            <input type="hidden" name="kode" value="<?php echo $data['name']; ?>">
            <div class="form-group">
                <label>Nama Film:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $data['name']; ?>">
            </div>
            <div class="form-group">
                <label>Tahun:</label>
                <input type="text" name="rdate" class="form-control" value="<?php echo $data['rdate']; ?>">
            </div>
            <div class="form-group">
                <label>Genre:</label>
                <input type="text" name="genre" class="form-control" value="<?php echo $data['genre']; ?>">
            </div>
            <div class="form-group">
                <label>Sinopsis:</label>
                <textarea name="sinopsis" class="form-control" rows="5" cols="20"><?php echo $data['sinopsis']; ?></textarea>
            </div><br><br>
            <button type="submit" name="submit" class="btn btn-danger">Simpan Perubahan</button>
        </form>
    </div>
      </div>
    </div>
</div>
    <!-- Memanggil file JavaScript Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
} else {
    // menampilkan pesan kesalahan jika parameter kode tidak ditemukan
    echo "<script>alert('Silahkan pilih film yang ingin di edit');document.location='movie-list.php'</script>";
}
?>