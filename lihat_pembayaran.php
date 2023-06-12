<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","novellaa");

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran 
	LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
	WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();


if (empty($detbay))
{
	echo "<script>alert('belum ada data pembayaran')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}


if ($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"])
{
	echo "<script>alert('anda tidak berhak melihat pembayaran')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
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
</ul>

<div class="container">
	<h3>Lihat Pembayaran</h3>
	<div class="row">
		<div class="col-md-6"></div>
		<table class="table">
			<tr>
				<th>Nama</th>
				<td><?php echo $detbay["nama"] ?></td>
			</tr>
			<tr>
				<th>Bank</th>
				<td><?php echo $detbay["bank"] ?></td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td><?php echo $detbay["tanggal"] ?></td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td>Rp. <?php echo number_format($detbay["jumlah"]) ?> </td>
			</tr>
			
		</table>
		<div class="col-md-6">
			<img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive">
		</div>
	</div>
</div>

</body>
</html>