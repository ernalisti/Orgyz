<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Data Mahasiswa</title>
    <meta name="description" content="Contoh HTML dengan Database MySQL">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fb;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #004d99;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }
        main {
            width: 80%;
            max-width: 900px;
            background: white;
            margin: 30px auto;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        form {
            background: #f9fafc;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-top: 10px;
        }
        input[type="text"], select, textarea {
            width: 95%;
            padding: 8px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #004d99;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #003366;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #004d99;
            color: white;
        }
    </style>
</head>
<body>
<header>
    <h1>Form Data Mahasiswa</h1>
</header>

<main>
<?php
// ==================
// 1️⃣ KONEKSI DATABASE
// ==================
$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Buat database kalau belum ada
mysqli_query($con, "CREATE DATABASE IF NOT EXISTS MahasiswaDB");
mysqli_select_db($con, "MahasiswaDB");

// Buat tabel jika belum ada
$buatTabel = "CREATE TABLE IF NOT EXISTS data_mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    nim VARCHAR(30),
    gender VARCHAR(15),
    olahraga VARCHAR(100),
    komentar TEXT
)";
mysqli_query($con, $buatTabel);

// ==================
// 2️⃣ SIMPAN DATA JIKA ADA INPUT
// ==================
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $nim = mysqli_real_escape_string($con, $_POST['nim']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $olahraga = isset($_POST['olahraga']) ? implode(", ", $_POST['olahraga']) : "";
    $komentar = mysqli_real_escape_string($con, $_POST['komentar']);

    $query = "INSERT INTO data_mahasiswa (nama, nim, gender, olahraga, komentar)
              VALUES ('$nama', '$nim', '$gender', '$olahraga', '$komentar')";
    mysqli_query($con, $query);
    echo "<p style='color:green;'>✅ Data berhasil disimpan!</p>";
}
?>

<!-- ==================
3️⃣ FORM INPUT DATA
================== -->
<form method="post">
    <label>Nama Mahasiswa:</label><br>
    <input type="text" name="nama" required placeholder="Tuliskan nama Anda"><br><br>

    <label>No. Induk Mhs:</label><br>
    <input type="text" name="nim" required placeholder="Tuliskan NIM Anda"><br><br>

    <label>Jenis Kelamin:</label><br>
    <select name="gender" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select><br><br>

    <label>Olahraga Favorit:</label><br>
    <input type="checkbox" name="olahraga[]" value="Renang"> Renang<br>
    <input type="checkbox" name="olahraga[]" value="Sepak Bola"> Sepak Bola<br>
    <input type="checkbox" name="olahraga[]" value="Pencak Silat"> Pencak Silat<br><br>

    <label>Komentar:</label><br>
    <textarea name="komentar" rows="3" placeholder="Tulis komentar di sini"></textarea><br><br>

    <input type="submit" value="Kirim">
</form>

<!-- ==================
4️⃣ TAMPILKAN DATA YANG SUDAH DISIMPAN
================== -->
<h2>Data Mahasiswa Tersimpan</h2>
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Jenis Kelamin</th>
        <th>Olahraga Favorit</th>
        <th>Komentar</th>
    </tr>
    <?php
    $result = mysqli_query($con, "SELECT * FROM data_mahasiswa ORDER BY id DESC");
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>".$no++."</td>
                <td>".$row['nama']."</td>
                <td>".$row['nim']."</td>
                <td>".$row['gender']."</td>
                <td>".$row['olahraga']."</td>
                <td>".$row['komentar']."</td>
              </tr>";
    }
    ?>
</table>
</main>
</body>
</html>
