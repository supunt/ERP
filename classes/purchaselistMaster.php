<?php 
require('db.php');

//print_r($_POST);
$postData = $_POST;

//----------------------------------------------------------
if (!isset($_POST['action']) || (($_POST['action'] != "add") && ($_POST['action'] != 'update')))
{
	$response['is_error'] = true;
	$response['error'] = "invalid action attempted.";
	echo json_encode($response);
	return;
}
$query = "";
//----------------------------------------------------------
if($_POST['action'] == 'add' || $_POST['action'] == 'update') {
	$pid = $postData['oid'];
	$podid = $postData['podid'];
	$partnumber = $postData['partnumber'];
	$location = $postData['location'];
	$quantity = $postData['quantity'];
	$cost = $postData['cost'];
	$duedate = $postData['duedate'];


	if($_POST['action'] == 'add') {
		$query = "INSERT into purchaseorderetails () VALUES('".$podid."','".$pid."', '". $partnumber ."','". $location ."','". $quantity ."','". $cost ."','". $duedate ."','null','null' )";

	}
	else {
		// do nothing for now
		$response['is_error'] = false;
    	echo json_encode($response);
    	return;	
	}

}
//Execute the query dude.
if ($conn->query($query) == true) {
    	$response['is_error'] = false;
    	echo json_encode($response);
    	return;
} 
else {
    $response['is_error'] = true;
	$response['error'] = "Error::Action failed, Contact administrator [Category tuncate 4].(Order id :".$postData['oid'].")";
	echo json_encode($response);
	return;
}

$conn->close();

?>