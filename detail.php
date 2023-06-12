<?php
session_start();
$koneksi = new mysqli("localhost","root","","novellaa");

$id_produk = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Novela </title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/detail.css">
</head>
<body>

	</div>
</div>
<center><h2>NOVELA</h2></center>
<ul>
  <li><a class="active" href="dashboard.php">Home</a></li>
  <li><a href="keranjang.php">Keranjang</a></li>
  <?php if (isset($_SESSION["pelanggan"])): ?>
  	<li><a href="riwayat.php">Riwayat Belanja</a></li>
  	<li><a href="logout.php">Logout</a></li>
  <?php else: ?>
  	<li><a href="login.php">Login</a></li>
  	<li><a href="daftar.php">Daftar</a></li>
  <?php endif ?>

  
  <li><a href="checkout.php">Checkout</a></li>
</ul>
</div>
<br>
<br>
<section class="kontent">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="foto_produk/<?php echo $detail['foto_produk']; ?>" alt="" class="img-responsive">
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail["nama_produk"] ?></h2>
				<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
				<h5>Stok : <?php echo $detail['stok_produk'] ?></h5>

				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk'] ?>">
						</div>
					</div>
					<div class="tombol">
						<button class="btn btn-primary" name="beli" style="margin-bottom: 50px;">Beli</button>
					</div><br>
				</form>
				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>
		<?php

		if (isset($_POST["beli"]))	
		{
			$jumlah = $_POST["jumlah"];

			$_SESSION["keranjang"][$id_produk] = $jumlah;

			echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
			echo "<script>location='keranjang.php';</script>";
		}
		?>
	</div>
</section>
</body>
</html>