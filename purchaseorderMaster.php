<?php 
require('db.php');

print_r($_POST);
$postData = $_POST;

if($_POST['formMethod'] == 'add' || $_POST['formMethod'] == 'update') {
	$vid = $postData['vid'];
	$wid = $postData['warehousecode'];
	

	if($_POST['formMethod'] == 'add') {
		$query = "INSERT into purchaseorder VALUES(NULL,'".$vid."', '". $wid ."', NOW(), NOW())";

	}else {
		$id = $_POST['itemID'];
		
		if($id == '') {
			echo "ERROR: Please contact administrator.";die();
		}
		$query = "UPDATE vendermaster SET vname='". $vname ."', description='". $des ."', address1='". $add1 ."', address2='". $add2 ."', suburb='". $suburb ."', state='". $state ."', postcode='". $postcode ."', country='". $country ."', termscode='". $termsCode ."', extrafield1='". $extraf1 ."', extrafield2='". $extraf2 ."', extrafield3='". $extraf3 ."' WHERE id=". $id;
		
		
	}

}else if($_GET['action'] == 'delete') {
	$id = $_GET['id'];
	
	if($id == '') {
		echo "ERROR: Please contact administrator.";die();
	}
	$query = "DELETE FROM vendermaster WHERE Id=". $id;
}

//Execute the query dude.
if ($conn->query($query) == TRUE) {
    	//echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . $conn->error; die('Please contact Administrator.');
}

$conn->close();

header("Location: ../purchase-order-list.php");
exit();
?>