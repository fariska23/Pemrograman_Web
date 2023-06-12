<?php
session_start();

$koneksi = new mysqli("localhost","root","","novellaa");


if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('keranjang kosong,silahkan pilih dulu');</script>";
	echo "<script>location='dashboard.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>keranjang belanja</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>

<!-- navbar -->
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
<section class="konten">
	<div class="container">
		<h1>Keranjang Belanja<h1>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subharga</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
				<?php
				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga = $pecah["harga_produk"]*$jumlah;
				?>
				<tr>
					<td><?php echo $nomor; ?></td><font size="40">
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($subharga); ?></td>
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>"class="btn btn-danger btn-xs">Hapus</a>
					</td>				
				</tr>
				<?php $nomor++; ?>
				<?php endforeach ?>
			</tbody>
		</table>
		<a href="dashboard.php" class="btn btn-default">Lanjut Belanja</a>
		<a href="checkout.php" class="btn btn-primary">Checkout</a>
	</div>	
</section>
</body>
</html>