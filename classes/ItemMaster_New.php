<?php 
require('db.php');

//print_r($_POST);
$postData = $_POST;

if (isset($_POST['formMethod']) ){

	if ($_POST['formMethod'] == 'add') {

		$sql = "SELECT * FROM items where itemname='" . $postData['itemname'] . "'";
		$rowResult = $conn->query($sql);

		if ($rowResult->num_rows > 0) {
			$row = mysqli_fetch_assoc($rowResult);
			if (strtoupper($row["itemname"]) == strtoupper($postData['itemname'])) {

				$msg = "Add new record failed. Item name already exists!";
				header("Location: ../Items_New.php?msg=" . $msg);
				die();
			}

		} else {
			$msg = "";
		}

	}



	if ($_POST['formMethod'] == 'add' || $_POST['formMethod'] == 'update') {
		$itemname = $postData['itemname'];
		$des = $postData['description'];
		$vendorID = $postData['vendorID'];
		$extrDesc = $postData['extradescription'];
		$purUOM = $postData['purchasingUOM'];
		$sellUOM = $postData['sellingUOM'];
		$stkUOM = $postData['stockingUOM'];
		$drawNo = $postData['drawingNumber'];
		$extraf1 = $postData['extraf1'];
		$extraf2 = $postData['extraf2'];
		$extraf3 = $postData['extraf3'];
		$cost = $postData['cost'];
		$lstPrice = $postData['listPrice'];
		$minBal = $postData['minbalance'];
		$leadTime = $postData['leadTime'];
		$abcCode = $postData['abcCode'];
		

		if ($_POST['formMethod'] == 'add') {
			$query = "INSERT into items
			VALUES(NULL,
			'" . $itemname . "', 
			'" . $vendorID . "',
			'" . $des . "', 
			'" . $extrDesc . "', 
			'" . $purUOM . "', 
			'" . $sellUOM . "', 
			'" . $stkUOM . "',
			'" . $drawNo . "', 
			'" . $cost . "', 
			'" . $lstPrice . "', 
			'" . $minBal . 	"', 
			'" . $leadTime . "', 
			'" . $abcCode . "',
			'" . $extraf1 . "',
			'" . $extraf2 . "',
			'" . $extraf3 . "',  
			NOW(), 
			NOW())";
			
			$msg = "Record added.";
			
		} else {
			$id = $_POST['itemID'];

			if ($id == '') {
				echo "ERROR: Please contact administrator.";
				die();
			}
			$query = "UPDATE items SET itemname='" . $itemname . "', description='" . $des . "', vendorID='" . $vendorID . "', extraDescription='" . $extrDesc . "', purchasingUOM='" . $purUOM . "', sellingUOM='" . $sellUOM . "', stockingUOM='" . $stkUOM . "', drawingNumber='" . $drawNo . "', cost='" . $cost . "', listPrice='" . $lstPrice . "', MinBalance='" . $minBal . "', leadTime='" . $leadTime . "', abcCode='" . $abcCode ."' WHERE id=" . $id;
		$msg = $minBal;
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
		$query = "DELETE FROM items WHERE Id=" . $id;
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

header("Location: ../Items_New.php?msg=".$msg);

exit();