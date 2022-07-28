<?php 
// cek apakah session login udah diset
session_start();
if(!isset($_SESSION['login'])){
    header('Location: login.php');
    exit;
}

require('functions.php');

$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

if(isset($_GET["halaman"])){
    $halamanAktif = $_GET["halaman"];
}
else{
    $halamanAktif = 1;
}
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$list_mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

if(isset($_POST['cari'])){
    $list_mahasiswa = cari($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar PHP</title>

    <style>
        .judul {
            font-weight: 700;
            margin-bottom: 50px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1 class="judul">Data Mahasiswa</h1>
    
    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>

    <form action="" method="POST">
        <input id="keyword" type="search" name="keyword" autocomplete="off" placeholder="Cari data mahasiswa">
        <button id="tombol-cari" type="submit" name="cari">Cari</button>
    </form>

    <br><br>

    <?php if($halamanAktif > 1) : ?>
        <a href="?halaman=<?php echo $halamanAktif-1 ?>">&lt;</a>
    <?php endif; ?>

    <!-- Navigasi  -->
    <?php for($i=1; $i<=$jumlahHalaman; $i++): ?>
        <?php if($i == $halamanAktif): ?>
            <a href="?halaman=<?php echo $i ?>" style="font-weight: bold; color: red;"><?php echo $i ?></a>
        <?php else: ?>
            <a href="?halaman=<?php echo $i ?>"><?php echo $i ?></a>
        <?php endif ?>
    <?php endfor ?>

    <?php if($halamanAktif < $jumlahHalaman) : ?>
        <a href="?halaman=<?php echo $halamanAktif+1 ?>">&gt;</a>
    <?php endif; ?>

    <div id="container">
        <table cellpadding='10' cellspacing='0'>
            <tr>
                <th>No</th>
                <th>Action</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
            </tr>

            <?php $i = 1 ?>
            <?php foreach($list_mahasiswa as $mhs): ?>
            <tr>
                <td><?php echo $i ?></td>
                <td>
                    <a href="ubah.php?id=<?php echo $mhs['id']; ?>">Ubah</a> |
                    <a href="hapus.php?id=<?php echo $mhs['id']; ?>">Hapus</a>
                </td>
                <td><img style="width: 30px; height: 30px;" src="img/<?php echo $mhs['gambar'] ?>" alt=""></td>
                <td><?php echo $mhs['nama']; ?></td>
                <td><?php echo $mhs['nim']; ?></td>
                <td><?php echo $mhs['jurusan']; ?></td>
            </tr>
            <?php $i++ ?>
            <?php endforeach ?>
        </table>
    </div>
    <script src="js/script.js">

    </script>
</body>
</html>