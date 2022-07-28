<?php 

session_start();
// cek apakah session login udah diset
if(!isset($_SESSION['login'])){
    header('Location: login.php');
    exit;
}

require('functions.php');

if(isset($_POST["submit"])){
    // cek apakah data berhasil ditambahkan atau tidak
    if(tambah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'index.php';
            </script>
        ";
    }
    else{
        echo "
            <script>
                alert('Data gagal ditambahkan');
            </script>
        ";
    }
    
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
        </div>

        <div>
            <label for="nim">NIM</label>
            <input type="text" name="nim" id="nim" required>
        </div>

        <div>
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" required>
        </div>

        <div>
            <label for="gambar"></label>
            <input type="file" name="gambar" id="gambar" accept="image/*">
        </div>

        <button type="submit" name="submit">Tambah</button>
    </form>
</body>
</html>