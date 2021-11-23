<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Koneksi ke database
require 'functions.php';


// Koneksi ke DBMS
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {


    // Ambil data dari tiap elemen dalam form
    // query insert data
    // Cek apakah data berhasil di tambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
          <script>
            alert('Data anda berhasil ditambahalkan!');
            document.location.href = 'Admin1.php';
          </script>
        ";
    } else {
        echo "
        <script>
            alert('Data anda gagal ditambahkan!');
            document.location.href = 'Admin1.php';
        </script>
        ";
    }
}
?>

<DOCTYPE html>
    <html>

    <head>
        <title>Tambah data mafia</title>
    </head>

    <body>
        <h1>Tambah data mafia</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="nama">Nama : </label>
                    <input type="text" name="nama" id="nama" required>
                </li>
                <li>
                    <label for="nrp">NRP : </label>
                    <input type="text" name="nrp" id="nrp" required>
                </li>
                <li>
                    <label for="email">Email : </label>
                    <input type="email" name="email" id="email" required>
                </li>
                <li>
                    <label for="pengalaman">Pengalaman : </label>
                    <input type="text" name="pengalaman" id="pengalaman" required>
                </li>
                <li>
                    <label for="gambar">Gambar : </label>
                    <input type="file" name="gambar" id="gambar">
                </li>
                <li>
                    <button type="submit" name="submit">Tambah data!</button>
                </li>
            </ul>
            <a href="Admin1.php">Home</a>
        </form>
    </body>

    </html>