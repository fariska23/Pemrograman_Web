<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","novellaa");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Novela </title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>



<!-- navbar -->
<div class="box-keranjang">
	<a href="keranjang.php" class="btn btn-info"><img class="posisi" src="css/keranjang.PNG" width="30" height="30"></a>
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
		<form action="pencarian.php" method="get" class="from-control">
				  <li><input type="text" class="pp" name="keyword" placeholder="Search.."></li>
				  <button class="btn tombol">Cari</button>		
		</form>
</ul>


<!-- konten -->
<section class="konten">
	<div class="container">
		<h1>Produk Terbaru</h1>

		<div class="row">
			
			<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
			<?php while($perproduk = $ambil->fetch_assoc()){ ?>

			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
					<div class="caption">
						<h3><?php echo $perproduk['nama_produk']; ?></h3>
						<h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
						<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
						<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-danger">Detail</a>
					</div>
				</div>
			</div>
			<?php } ?>

		</div>
	</div>
</section>

</body>
</html>