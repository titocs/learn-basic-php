<?php 

require('functions.php');

if(isset($_POST['register'])){
    if(registrasi($_POST) > 0){
        echo "<script>
                alert('User baru berhasil ditambahkan');
              </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>

    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1>Halaman Registrasi</h1>
    <form action="" method="POST">
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <label for="password2">Retype Password:</label>
        <input type="password" name="password2" id="password2" required>
    </div>
    <button type="submit" name="register">Regster</button>
    </form>
</body>
</html>