<?php
session_start();
if (isset($_POST['upload'])) {

  include 'koneksi.php';

  $targetvid = "video-uploads/".basename($_FILES['video']['name']);
  $target = "uploads/".basename($_FILES['image']['name']);
  $name = strtolower($_POST['mname']);
  $rdate = $_POST['release'];
  $genre = strtolower($_POST['genre']);
  $image = $_FILES['image']['name'];
  $video = $_FILES['video']['name'];
  $sinopsis = $_POST['sinopsis'];

  if ($name == "") {
    echo "Maaf, Judul Film Tidak Boleh Kosong !";
} else if ($rdate == "") {
    echo "Maaf, years Tidak Boleh Kosong !";
} else if ($genre == "Pilih Jenis Kelamin...." or $genre == "") {
    echo "Maaf, genre Belum Ditentukan !";
} else if ($sinopsis == "") {
    echo "Maaf, sinopsis Tidak Boleh Kosong !";
} else if ($image == "") {
    echo "Maaf, image Tidak Boleh Kosong !";
} else if ($video == "") {
    echo "Maaf, video Tidak Boleh Kosong !";
} else if ($name !== "") {
    $sql1    = "SELECT * FROM movies WHERE name = '$name'";
    $q1      = mysqli_query($conn, $sql1);
    $n1      = mysqli_num_rows($q1);
    
  $sql = "INSERT INTO movies (name, rdate, genre, imgpath, videopath, sinopsis)
    VALUES('$name','$rdate','$genre','$image','$video', '$sinopsis')";

  mysqli_query($conn,$sql);

  if (move_uploaded_file($_FILES['image']['tmp_name'],$target) && move_uploaded_file($_FILES['video']['tmp_name'],$targetvid)) {
    mysqli_query($conn,$sql);
    header("Location: index.php");
  } else {
    echo "error uploading";
    // menghapus data yang telah disimpan ke database jika file tidak berhasil diunggah
    $sql_delete = "DELETE FROM movies WHERE name='$name' AND rdate='$rdate' AND genre='$genre'";
    mysqli_query($conn,$sql_delete);
  }
}
}
?>

