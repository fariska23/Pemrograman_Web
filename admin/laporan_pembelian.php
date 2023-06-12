<?php
$semuadata=array();
$tgl_mulai="-";
$tgl_selesai="-";
$status = "";
if (isset($_POST["kirim"])) 
{
	$tgl_mulai = $_POST['tglm'];
	$tgl_selesai = $_POST['tgls'];
	$status = $_POST["status"];
	$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
	while($pecah = $ambil->fetch_assoc())
	{
		$semuadata[]=$pecah;
	}

}

?>

<h2>Laporan Pembelian dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?></h2>
<hr>

<form method="post">
	<div class="row">
		<div class="col-md-3">
			<label>Tanggal Mulai</label>
			<input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
		</div>
		<div class="col-md-3">
			<label>Tanggal Selesai</label>
			<input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
		</div>
		<div class="col-md-3">
			<label>Status</label>
			<select class="form-control" name="status">
				<option value="">Pilih Status</option>
				<option value="pending" <?php echo $status=="pending"?"selected":""; ?>  >pending</option>
				<option value="sudah melakukan pembayaran"   <?php echo $status=="sudah melakukan pembayaran"?"selected":""; ?> >sudah melakukan pembayaran</option>
				<option value="Lunas"   <?php echo $status=="Lunas"?"selected":""; ?> >Lunas</option>
				<option value="barang dikirim"  <?php echo $status=="barang dikirim"?"selected":""; ?> >barang dikirim</option>
				<option value="batal"  <?php echo $status=="batal"?"selected":""; ?> >batal</option>
			</select>
		</div>
		<div class="col-md-2">
			<label>&nbsp;</label><br>
			<button class="btn btn-primary" name="kirim">Lihat</button>
		</div>
	</div>
</form>
<br>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Status</th>
			<th>Jumlah</th>
		</tr>
	</thead>
	<tbody>
		<?php $total=0; ?>
		<?php foreach ($semuadata as $key => $value): ?>
		<?php $total+=$value['total_pembelian'] ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $value["nama_pelanggan"] ?></td>
			<td><?php echo date("d F Y",strtotime($value["tanggal_pembelian"])) ?></td>
			<td>Rp. <?php echo number_format($value["total_pembelian"]) ?></td>
			<td><?php echo $value["status_pembelian"] ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4">Total</th>
			<th>Rp. <?php echo number_format($total) ?></th>
		</tr>
	</tfoot>
</table>