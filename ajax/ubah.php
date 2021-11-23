<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

// Ambil data di URL
$id = $_GET["id"];


// query data mahasiswa berdasarkan id
$maf = query("SELECT * FROM mafia WHERE id = $id")[0];



// Koneksi ke DBMS
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // Ambil data dari tiap elemen dalam form
    // query insert data
    // Cek apakah data berhasil di ubah atau belum
    if (ubah($_POST) > 0) {
        echo "
          <script>
            alert('Data anda berhasil diubah!');
            document.location.href = 'Admin1.php';
          </script>
        ";
    } else {
        echo "
        <script>
            alert('Data anda gagal diubah!');
            document.location.href = 'Admin1.php';
        </script>
        ";
    }
}
?>

<DOCTYPE html>
    <html>

    <head>
        <title>Ubah data mafia</title>
    </head>

    <body>
        <h1>Ubah data mafia</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $maf["id"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $maf["gambar"]; ?>">
            <ul>
                <li>
                    <label for="nama">Nama : </label>
                    <input type="text" name="nama" id="nama" required value="<?= $maf["nama"]; ?>">
                </li>
                <li>
                    <label for="nrp">NRP : </label>
                    <input type="text" name="nrp" id="nrp" required value="<?= $maf["nrp"]; ?>">
                </li>
                <li>
                    <label for="email">Email : </label>
                    <input type="email" name="email" id="email" required value="<?= $maf["email"]; ?>">
                </li>
                <li>
                    <label for="pengalaman">Pengalaman : </label>
                    <input type="text" name="pengalaman" id="pengalaman" required value="<?= $maf["pengalaman"]; ?>">
                </li>
                <li>
                    <label for="gambar">Gambar : </label><br>
                    <img src="img/<?= $maf["gambar"]; ?>" width="50"><br>
                    <input type="file" name="gambar" id="gambar">
                </li>
                <li>
                    <button type="submit" name="submit">Ubah data!</button>
                </li>
            </ul>
            <a href="Admin1.php">Home</a>
        </form>
    </body>

    </html>