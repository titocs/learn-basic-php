<?php

require('connect.php');

// Ambil data
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $jurusan = htmlspecialchars($data['jurusan']);

    // upload gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }

    $sql_query = "INSERT INTO mahasiswa VALUES ('', '$nama', '$nim', '$jurusan', '$gambar')";
    mysqli_query($conn, $sql_query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tempName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4 ){
        echo "<script>
                alert('Silahkan pilih gambar terlebih dahulu');
            </script>
        ";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
                alert('Yang anda upload bukan gambar');
            </script>    
        ";
        return false;
    }


    if($ukuranFile > 1000000){
       echo "<script>
                alert('Ukuran gambar terlalu besar');
            </script>    
        ";
        return false;
    }

    // Gambar siap diupload
    // generate nama baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tempName, 'img/'.$namaFileBaru);

    return $namaFileBaru;
}

function hapus($id){
    global $conn;

    $sql_query = "DELETE FROM mahasiswa WHERE id=$id";
    mysqli_query($conn, $sql_query);
    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    // cek user klik tombol upload ga
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }
    else{
        $gambar = upload();
    }

    $sql_query = "UPDATE mahasiswa SET nama='$nama', nim='$nim', jurusan='$jurusan', gambar='$gambar' WHERE id=$id";
    mysqli_query($conn, $sql_query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $sql_query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
    return query($sql_query);
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // cek username udah ada sebelumnya atau belom
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username='$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username yang dipilih sudah terdaftar sebelumnya');
              </script>";
        return false;
    }

    // cek konfirmasi password
    if($password !== $password2){
        echo "<script>
                alert('tidak sesuai');
              </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}

?>