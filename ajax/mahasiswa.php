<?php 

require("../functions.php");
$keyword = $_GET["keyword"];
$list_mahasiswa = query("SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'");

?>

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