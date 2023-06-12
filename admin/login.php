<?php
session_start();
// koneksi
$koneksi = new mysqli("localhost","root","","novellaa");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Novela</title>
    <title>Novela</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<head>      
<h1>Novela</h1>
<h2>Login</h2>
</head>
<body id="bg-login">
    <div class="box-login">
        <form method="post">
            <div class="txt" required>
                <input type="email" name="email" placeholder="email" class="input-control">
            </div>
            <div class="txt_field">
                <input type="password" name="pass" placeholder="password" class="input-control">
            </div>
            <div class="pass">Forgot Password?<a href="Lupa.php" class="btn">Lupa</a>
            <input type="submit" name="login" value="Login">
            <div class="signup_link">
                Not a member? <a href="Signup.php" class="btn">Signup</a>
        </form>
        <?php
            if (isset($_POST['login']))
            {
                $ambil=$koneksi->query("SELECT * FROM admin WHERE username='$_POST[email]' AND password = md5('$_POST[pass]')");
                $yangcocok = $ambil->num_rows;
                if ($yangcocok==1) 
                {
                    $_SESSION['admin']=$ambil->fetch_assoc();
                    echo "<div class='alert alert-info'>Login Sukses</div>";
                    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                }
                else
                {
                    echo '<script>alert("email atau password Anda salah!")</script>';
                    echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                }
            }
            ?>
    </div>
</body>
</html>