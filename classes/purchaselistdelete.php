<?php 
require('db.php');

if(!isset($_POST['action']) && ($_POST['action'] != 'delete')) {
	$response['is_error'] = true;
	$response['error'] = "Error::Invalid action, Contact administrator [Category tuncate 1]";
	echo json_encode($response);
	return;
}

if(!isset($_POST['oid'])) {
	$response['is_error'] = true;
	$response['error'] = "Error::Invalid action, Contact administrator [Category tuncate 2]";
	echo json_encode($response);
	return;
}

$oid = $_POST['oid'];
if($oid == '') {
	$response['is_error'] = true;
	$response['error'] = "Error::Invalid action, Contact administrator [Category tuncate 3]";
	echo json_encode($response);
	return;
}

$query = "DELETE FROM purchaseorderetails WHERE pid=". $oid;


if ($conn->query($query) == TRUE) {
    	$response['is_error'] = false;
    	echo json_encode($response);
    	return;
} 
else {
    $response['is_error'] = true;
	$response['error'] = "Error::Action failed, Contact administrator [Category tuncate 4].(Order id :".$oid.")";
	echo json_encode($response);
	return;
}

$conn->close();
?>