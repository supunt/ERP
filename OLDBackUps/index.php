<?php require('header.php'); ?>
<?php require('classes/db.php'); ?>
<?php 
$method = 'add';
$id = '';
$alldata = "SELECT * FROM vendermaster order by Id desc";
$result = $conn->query($alldata);

if (isset($_GET['action'])) {

	if ($_GET['action'] == 'update') {

		$method = 'update';
		$id = $_GET['id'];
		$rowData = "SELECT * FROM vendermaster where Id=" . $id;
		$rowResult = $conn->query($rowData);

		if ($rowResult->num_rows == 0) {
			echo "There is no data for this ID. Please contact administrator.";
			die();
		}

		$updaterow = mysqli_fetch_assoc($rowResult);
	}
}

?>
<body>

<div class="container">
	<?php require('topNav.php'); ?>
 </div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>