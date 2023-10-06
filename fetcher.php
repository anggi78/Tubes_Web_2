<?php
include 'koneksi.php';

echo "<link rel='stylesheet' href='css/app.css'>";
echo "<link rel='stylesheet' href='css/bootstrap.css'>";

// Tentukan jumlah data per halaman
$per_halaman = 3;

// Tentukan halaman saat ini
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

// Tentukan offset data
$offset = ($halaman - 1) * $per_halaman;

// // Query untuk menampilkan data dengan pagination
$im = "SELECT * FROM movies ORDER BY mid DESC LIMIT $offset, $per_halaman";
$records = mysqli_query($conn, $im);

// Hitung jumlah halaman
$jumlah_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM movies"));
$jumlah_halaman = ceil($jumlah_data / $per_halaman);

echo "<div class='card-group justify-content-center border-0'>";

while ($result = mysqli_fetch_assoc($records)) {
  echo "<form action='movie.php' method='POST'>";
  echo "<div class='card-transparent justify-content-center border-0'>";
  echo "<img src='uploads/".$result['imgpath']."' height='400' width='300' style='margin: 30px;'>";
  echo "<div class='noob'>";
  echo "<input type='submit' name='submit' class='btn btn-danger' style='display: block; width: 300px; margin: 0 30px 30px 30px;' value='".ucwords($result['name'])."'>";
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
  echo "<li class='page-item'><a class='page-link' href='?halaman=$prev'>Previous</a></li>";
} else {
  echo "<li class='page-item disabled'><a class='page-link' href='#'>Previous</a></li>";
}

for ($i=1; $i<=$jumlah_halaman; $i++) {
  if ($i == $halaman) {
    echo "<li class='page-item active'><a class='page-link' href='?halaman=$i'>$i</a></li>";
  } else {
    echo "<li class='page-item'><a class='page-link' href='?halaman=$i'>$i</a></li>";
  }
}

// Tombol "Next"
if ($halaman < $jumlah_halaman) {
  $next = $halaman + 1;
  echo "<li class='page-item'><a class='page-link' href='?halaman=$next'>Next</a></li>";
} else {
  echo "<li class='page-item disabled'><a class='page-link' href='#'>Next</a></li>";
}

echo "</ul>";
echo "</nav>";
?>
