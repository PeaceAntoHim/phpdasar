<?php
// Koneksi ke database
$conn = mysqli_connect("sql103.epizy.com", "epiz_30288269", "95o2gd2soBc", "epiz_30288269_phpdasar");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data)
{
    // Ambil data dari tiap elemen dalam form
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $pengalaman = htmlspecialchars($data["pengalaman"]);

    // Upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mafia
    VALUES
    ('', '$nama', '$nrp', '$email', '$pengalaman', '$gambar')           
";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}



// Function Upload
function upload()
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang di upload

    if ($error === 4) {
        echo "<script>
                    alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // Cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // Lolos pengecekan, gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}














// Function hapus data

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mafia WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Function ubah data
function ubah($data)
{
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $pengalaman = htmlspecialchars($data["pengalaman"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $gambar = htmlspecialchars($data["gambar"]);

    // Cek apakah user pilih gambar baru atau tidak 
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }






    $query = "UPDATE mafia SET
            nama = '$nama',
            nrp = '$nrp',
            email = '$email',
            pengalaman = '$pengalaman',
            gambar = '$gambar' 
            WHERE id = $id 
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM mafia
                WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            pengalaman LIKE '%$keyword%'
    ";
    return query($query);
}

// functions registrasi

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek apakah username sudah ada atau belum 
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username ='$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar');
            </script>";
        return false;
    }


    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }
    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);



    // tambahakan user baru ke database

    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
