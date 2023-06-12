<?php
session_start();
// koneksi
$koneksi = new mysqli("localhost","root","","novellaa");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/login.css">

    <link href="assets/css/style.css" rel="stylesheet" />

    <title>Login Form - Pure Coding</title>
</head>
<body id="bg-login">
    <div class="box-login">
        <form method="post">
            <div class="txt" required>
                <input type="email" placeholder="Email" name="email" class="input-control">
            </div>
            <div class="txt_field">
                <input type="password" placeholder="password" name="password" class="input-control">
            </div>
            <div class="pass">Forgot Password?<a href="Lupa.php" class="btn">Lupa</a>
            <input type="submit" name="login" value="Login">
           <div class="signup_link">
				Not a member? <a href="daftar.php" class="btn">Signup</a>
        </form>
        <?php
if (isset($_POST["login"])) 
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    // lakukan kuery ngecek akun di tabel pelanggan di db
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan=md5('$password')");

    // ngitung akun yang terambil
    $akunyangcocok = $ambil->num_rows;

    // jika 1 akun yang cocok, maka login
    if ($akunyangcocok==1)
    {
        //anda sukses login
        //mendapatkan akun dlm bentuk array
        $akun = $ambil->fetch_assoc();
        //simpan di session pelanggan
        $_SESSION['pelanggan'] = $akun;
        echo "<script>alert('anda sukses login');</script>";

        if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
        {
            echo "<script>location='checkout.php';</script>";
        }
        else
        {
            echo "<script>location='riwayat.php';</script>";
        }
       
    }
    else
    {
        echo "<script>alert('anda gagal login, priksa akun anda');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>
    </div>
</body>
</html>