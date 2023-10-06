<?php
session_start();
require('../koneksi.php');

if (isset($_POST['upload'])) {
    // Process form data here

    // Display the alert message
    $_SESSION['message'] = 'Ulasan berhasil dikirim!';
}

$nama = isset($_POST['mnama']) ? $_POST['mnama'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$komentar = isset($_POST['komentar']) ? $_POST['komentar'] : NULL;

// Validasi data tidak boleh kosong
if (!$nama || !$email || !$komentar) {
    $_SESSION['message'] = 'Data tidak boleh kosong';
} else {
    // Cek apakah email sudah terdaftar sebelumnya
    $sql = "SELECT * FROM ulasan WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Jika email sudah terdaftar, update komentar terbaru
        $sql = "UPDATE ulasan SET komentar='$komentar' WHERE email='$email'";
        if (mysqli_query($conn, $sql)) {
            // Upload file jika ada
            if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['fileToUpload']['tmp_name'];
                $file_name = $_FILES['fileToUpload']['name'];
                $file_path = "uploads/" . $file_name;

                if (move_uploaded_file($file_tmp, $file_path)) {
                    $_SESSION['message'] = 'Data berhasil diupdate';
                } else {
                    $_SESSION['message'] = 'Error uploading';
                }
            }
        } else {
            $_SESSION['message'] = 'Gagal mengupdate data';
        }
    } else {
        // Jika email belum terdaftar, input data baru
        $sql = "INSERT INTO ulasan (nama, email, komentar)
            VALUES('$nama','$email','$komentar')";

        if (mysqli_query($conn, $sql)) {
            // Upload file jika ada
            if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['fileToUpload']['tmp_name'];
                $file_name = $_FILES['fileToUpload']['name'];
                $file_path = "uploads/" . $file_name;

                if (move_uploaded_file($file_tmp, $file_path)) {
                    $_SESSION['message'] = 'Data berhasil diinput';
                } else {
                    $_SESSION['message'] = 'Error uploading';
                }
            }
        } else {
            $_SESSION['message'] = 'Gagal menambahkan data';
        }
    }
}

header("Location: user2.php"); // Redirect to the previous page
exit;
?>
