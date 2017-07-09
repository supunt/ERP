<?php 
require('db.php');

//print_r($_POST);
$postData = $_POST;

if($_POST['formMethod'] == 'add' || $_POST['formMethod'] == 'update') {
	$itname = $postData['itemname'];
	$des = $postData['description'];
	$exdes = $postData['extradescription'];
	$purchasingUOM = $postData['purchasingUOM'];
	$sellingUOM = $postData['sellingUOM'];
	$stockingUOM = $postData['stockingUOM'];
	$drawingNumber = $postData['drawingNumber'];
	$cost = $postData['cost'];
	$listPrice = $postData['listPrice'];
	$minbalance = $postData['minbalance'];
	$leadTime = $postData['leadTime'];
	$vendorID = $postData['vendorID'];
	$abcCode = $postData['abcCode'];
	$extraf1 = $postData['extraf1'];
	$extraf2 = $postData['extraf2'];
	$extraf3 = $postData['extraf3'];

	if($_POST['formMethod'] == 'add') {
		$query = "INSERT into items VALUES(NULL,'".$itname."', '". $vendorID ."', '". $des ."',  '". $exdes ."', '" . $purchasingUOM ."', '". $sellingUOM ."', '". $stockingUOM ."', 
			'". $drawingNumber ."', '". $cost ."', '". $listPrice ."','". $minbalance ."', '". $leadTime ."', '". $abcCode ."', '". $extraf1 ."', '". $extraf2 ."', '". $extraf3 ."', NOW(), NOW())";

	}else {
		$id = $_POST['itemID'];
		
		if($id == '') {
			echo "ERROR: Please contact administrator.";die();
		}
		$query = "UPDATE items SET itemname='". $itname ."',description='". $des ."', vendorID='". $vendorID ."', extradescription='". $exdes ."', purchasingUOM='". $purchasingUOM ."', sellingUOM='". $sellingUOM ."', stockingUOM='". $stockingUOM ."', 
		drawingNumber='". $drawingNumber ."', cost='". $cost ."', listPrice='". $listPrice ."', minbalance='". $minbalance ."' , leadTime='". $leadTime ."', abcCode='". $abcCode ."', exfield1='". $extraf1 ."', exfield2='". $extraf2 ."', 
		exfield3='". $extraf3 ."' WHERE Id=". $id;
		
	}

}else if($_GET['action'] == 'delete') {
	$id = $_GET['id'];
	
	if($id == '') {
		echo "ERROR: Please contact administrator.";die();
	}
	$query = "DELETE FROM items WHERE Id=". $id;
}

//Execute the query dude.
if ($conn->query($query) == TRUE) {
    	//echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . $conn->error; die('Please contact Administrator.');
}

$conn->close();

header("Location: ../items2.php");
exit();
?>