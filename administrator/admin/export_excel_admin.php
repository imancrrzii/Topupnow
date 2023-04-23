<?php
include('../../config/database.php');
require('../fpdf184/fpdf.php');

$base_url = new BaseUrl();
define('base_url', $base_url->getBaseUrl());

$db = new Database();
$conn = $db->getConnection();
?>

<table class="table table-bordered table-hover" id="example">
	<thead>
		<tr>
			<th>No</th>
			<th>ID Admin</th>
			<th>Nama Lengkap</th>
			<th>Username</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		$query = "SELECT * FROM administrator";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)) {

			$id = $row['id'];
			$full_name = $row['full_name'];
			$username = $row['username'];
		?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $id ?></td>
			<td><?= $full_name ?></td>
			<td><?= $username ?></td>			
		</tr>
		<?php
		}
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data Admin.xls");
		?>
	</tbody>	
</table>