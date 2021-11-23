<?php
usleep(500000);

require '../functions.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM mafia
            WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            pengalaman LIKE '%$keyword%'
        ";
$mafia = query($query);

?>


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