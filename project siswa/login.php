<?php 
session_start();
require 'functions.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result)) {
        $data = mysqli_fetch_assoc($result);
        if (password_verify($password, $data['password'])) {
            $_SESSION['login'] = true;
            header('Location: index.php');
            exit;
        } else {
            echo "<script>
                alert('password salah');
            </script>";
        }

    } else {
        echo "<script>
                alert('username belum terdaftar');
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
    <title>Login</title>
</head>
<body>
    <h1>Form Login</h1>
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
                <td></td>
                <td></td>
                <td><button type="submit" name="login">Login</button> | <a href="registration.php">Registration</a></td>
            </tr>
        </table>
    </form>
</body>
</html>