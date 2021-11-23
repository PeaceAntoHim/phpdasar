<?php
session_start();

// Cek apakah SESSION ada
if (!isset($_SESSION["login"])) {
    header("location: login.php");
}

// koneksi ke fuction untuk menyambungkan ke database
require "functions.php";

$mafia = query("SELECT * FROM mafia ORDER BY id DESC");

// Tombol cari ditekan
if (isset($_POST["cari"])) {
    $mafia = cari($_POST["keyword"]);
}


?>



<!DOCTYPE html>
<html>

<head>
    <title>Halaman Admin</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 120px;
            left: 280px;
            z-index: -1;
            display: none;
        }
    </style>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <a href="logout.php">Logout</a>


    <h1>Daftar Mafia</h1>

    <a href="tambah.php">Tambah data mafia</a>
    <br><br>
    <form action="" method="post">

        <input type="text" name="keyword" size="40" autofocus placeholder="Masukan keyword pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>

        <img src="img/loader.gif" class="loader">

    </form>
    <br>
    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <br>
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Gambar</th>
                <th>NRP</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pengalaman</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($mafia as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a>
                        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
                    </td>
                    <td><img src="img/<?= $row["gambar"]; ?>"></td>
                    <td><?= $row["nrp"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td><?= $row["pengalaman"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>

</html>