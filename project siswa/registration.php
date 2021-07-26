<?php 
    require 'functions.php';
    if(isset($_POST['submit'])) {
        if (register($_POST) > 0) {
            echo "<script>
                alert('registrasi berhasil');
                document.location.href = 'login.php';
            </script>";
        } else {
            echo "<script>
                alert('registrasi gagal');
            </script>";
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
    <h1>Form Registrasi</h1>
    <form action="" method="POST">
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
                <td>Confirm Password</td>
                <td>:</td>
                <td><input type="password" name="password2"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" name="submit">Register</button> | <a href="login.php">Login</a></td>
            </tr>
        </table>
    </form>
</body>
</html>