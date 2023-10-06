<?php
//cek dulu apakah parameter kode ada atau tidak
if(isset($_GET['kode'])){
   include "koneksi.php";
   //kalo ada berarti lakukan perintah delete
   $kode = $_GET['kode'];
   $sql = "DELETE FROM movies WHERE name='$kode'";
   $kueri = mysqli_query($conn, $sql);
   if($kueri){
       //kalo deletenya berhasil
    //tampilkan alert dan pindah ke halaman daftar barang
    echo "<script>alert('Film berhasil dihapus');document.location='movie-list.php'</script>";
   } else{
   echo "<script>alert('Film Gagal dihapus');document.location='movie-list.php'</script>";
   }
} else {
    //kalo gak ada  parameternya
    echo "<script>alert('Silahkan pilih film yang ingin dihapus');document.location='movie-list.php'</script>";
}
?>