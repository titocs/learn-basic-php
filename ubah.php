<?php 

session_start();
// cek apakah session login udah diset
if(!isset($_SESSION['login'])){
    header('Location: login.php');
    exit;
}

require('functions.php');

$id = $_GET['id'];

// Mengambil data mahasiswa berdasarkan ID
$mhs = query("SELECT * FROM mahasiswa WHERE id=$id")[0];

if(isset($_POST["submit"])){
    // cek apakah data berhasil ditambahkan atau tidak
    if(ubah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'index.php';
            </script>
        ";
    }
    else{
        echo "
            <script>
                alert('Data gagal diubah');
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
    <title>Ubah Data</title>
</head>
<body>
    <h1>Ubah Data Mahasiswa</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mhs['id']; ?>">
        <input type="hidden" name="gambarLama" value="<?php echo $mhs['gambar']; ?>">
        <div>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required value="<?php echo $mhs['nama']; ?>">
        </div>

        <div>
            <label for="nim">NIM</label>
            <input type="text" name="nim" id="nim" required value="<?php echo $mhs['nim']; ?>">
        </div>

        <div>
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" required value="<?php echo $mhs['jurusan']; ?>">
        </div>

        <div>
            <label for="gambar">Gambar</label> <br>
            <img src="img/<?php echo $mhs['gambar']; ?>" width="40" alt=""> <br>
            <input type="file" name="gambar" id="gambar" value="<?php echo $mhs['gambar']; ?>">
        </div>

        <button type="submit" name="submit">Ubah</button>
    </form>
</body>
</html>