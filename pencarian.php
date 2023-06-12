<?php
session_start();
$koneksi = new mysqli("localhost","root","","novellaa");
$keyword = $_GET["keyword"];

$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
While($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
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

<form action="pencarian.php" method="get" class="navbar-form navbar-right">
	<input type="text" name="form-control" name="keyword">
	<button class="btn btn-primary">Cari</button>
	
</form>


<script type="text/javascript">
  window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);
  })
</script>

<br>
<br>
	<div class="container">
		<h3>Hasil Pencarian : <?php echo $keyword ?></h3>
		
		<?php if (empty($semuadata)): ?>
			<div class="alert alert-danger">Produk <strong><?php echo $keyword ?></strong> tidak ditemukan</div>
		<?php endif ?>
		<div class="row">

			<?php foreach ($semuadata as $key => $value): ?>

			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $value["foto_produk"] ?>" alt="" class="img-responsive">
					<div class="caption">
						<h3><?php echo $value["nama_produk"] ?> produk</h3>
						<h5>Rp. <?php echo number_format($value['harga_produk']) ?></h5>
						<a href="beli.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-primary">Beli</a>
						<a href="detail.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-default">Detail</a>
					</div>
				</div>
			</div>
			<?php endforeach ?>

		</div>
	</div>
</body>
</html>