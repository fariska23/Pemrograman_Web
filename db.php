<?PHP
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$dbname	  = 'novellaa';

	$conn     = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal terhubung ke database')
?>