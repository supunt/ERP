<?php 
require('db.php');

//print_r($_POST);
$postData = $_POST;

if (isset($_POST['formMethod']) ){

	if ($_POST['formMethod'] == 'add') {

		$sql = "SELECT * FROM vendermaster where vname='" . $postData['vname'] . "'";
		$rowResult = $conn->query($sql);

		if ($rowResult->num_rows > 0) {
			$row = mysqli_fetch_assoc($rowResult);
			if (strtoupper($row["vname"]) == strtoupper($postData['vname'])) {

				$msg = "Add new record failed. Vendor name already exists!";
				header("Location: ../vender.php?msg=" . $msg);
				die();
			}

		} else {
			$msg = "";
		}

	}



	if ($_POST['formMethod'] == 'add' || $_POST['formMethod'] == 'update') {
		$vname = $postData['vname'];
		$des = $postData['description'];
		$add1 = $postData['addess1'];
		$add2 = $postData['addess2'];
		$suburb = $postData['suburb'];
		$state = $postData['state'];
		$postcode = $postData['postcode'];
		$termsCode = $postData['termsCode'];
		$country = $postData['country'];
		$extraf1 = $postData['extraf1'];
		$extraf2 = $postData['extraf2'];
		$extraf3 = $postData['extraf3'];

		if ($_POST['formMethod'] == 'add') {

			$query = "INSERT into vendermaster VALUES(NULL,'" . $vname . "', '" . $des . "', '" . $add1 . "', '" . $add2 . "', '" . $suburb . "', '" . $state . "',
			'" . $postcode . "', '" . $country . "', '" . $termsCode . "', '" . $extraf1 . "', '" . $extraf2 . "', '" . $extraf3 . "', NOW(), NOW())";
			$msg = "Record added.";
			
		} else {
			$id = $_POST['itemID'];

			if ($id == '') {
				echo "ERROR: Please contact administrator.";
				die();
			}
			$query = "UPDATE vendermaster SET vname='" . $vname . "', description='" . $des . "', address1='" . $add1 . "', address2='" . $add2 . "', suburb='" . $suburb . "', state='" . $state . "', postcode='" . $postcode . "', country='" . $country . "', termscode='" . $termsCode . "', extrafield1='" . $extraf1 . "', extrafield2='" . $extraf2 . "', extrafield3='" . $extraf3 . "' WHERE id=" . $id;
			$msg = "Record updated.";

		}

	}
}

if ( isset( $_GET['action'] ) ) {
	if ($_GET['action'] == 'delete') {

		$id = $_GET['id'];

		if ($id == '') {
			echo "ERROR: Please contact administrator.";
			die();
		}
		$query = "DELETE FROM vendermaster WHERE Id=" . $id;
		$msg = "Record deleted.";
	}
}

//Execute the query dude.
if ($query != "") {
	if ($conn->query($query) == true) {
		//echo "New record created successfully";
	} else {
		$msg = "Error: " . $query . "<br>" . $conn->error;
		//die('Please contact Administrator.');
	}
}

$conn->close();

header("Location: ../vender.php?msg=" .$msg);
die();

exit();