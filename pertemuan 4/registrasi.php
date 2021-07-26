<?php
require 'functions.php';
    if(isset($_POST['register'])) {
        if (register($_POST) > 0) {
            echo "
                <script>
                    alert('user baru berhasil ditambahkan');
                </script>
            ";
        } else {
            echo mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h3>Form Registrasi</h3>
    <form action="" method="POST">
        <input type="hidden" name="role_id" value="1">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Konfirmasi Password</td>
                <td>:</td>
                <td><input type="password" name="password2"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" name="register">Submit</button> | <a href="login.php">Login</a></td>
            </tr>
        </table>
    </form>
</body>
</html>