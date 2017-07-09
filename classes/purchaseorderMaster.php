<?php 
require('db.php');

$postData = $_POST;
$query = "";

//----------------------------------------------------------
if (!isset($_POST['action']) || (($_POST['action'] != "add") && ($_POST['action'] != "update") && ($_POST['action'] != "delete")))
{
	$response['is_error'] = true;
	$response['error'] = "invalid action attempted.";
	echo json_encode($response);
	return;
}
//----------------------------------------------------------
if (isset($_POST['action']) && (($_POST['action'] == "add") || ($_POST['action'] == "update")))
{
	$vid = $postData['vid'];
	$wid = $postData['wid'];

	if($_POST['action'] == "add") 
	{
		$query = "INSERT into purchaseorder (vendorno, warehousecode,adddate,updatedate) VALUES('".$vid."', '". $wid ."', NOW(), NOW())";
	}
	else 
	{
		$id = isset($_POST['orderId'])?$_POST['orderId']:'';
		
		if($id == '') 
		{
			$err['is_error'] = true;
			$err['error'] = "ERROR::Critical::blank order id, contact administrator. Action 'Update'";
			echo json_encode($err);
			die();
		}
		$query = "UPDATE purchaseorder SET vendorno='". $vid ."', warehousecode='". $wid ."', updatedate=NOW() WHERE pid=". $id;	
	}

}
else if ($_POST['action'] == "delete") 
{
	$id = isset($_POST['orderId'])?$_POST['orderId']:'';
	
	if($id == '') {
		$err['is_error'] = true;
		$err['error'] = "ERROR::Critical::blank order id, contact administrator. Action 'Delete'";
		echo json_encode($err);
		return;
	}
	$query = "DELETE FROM purchaseorder WHERE pid=". $id;
}

//Execute the query dude.
if ($conn->query($query) == TRUE) {
   	$response['is_error'] = false;
   	$response['row_num'] = $conn->insert_id;
   	echo json_encode($response);
} else {
    $response['is_error'] = true;
    $response['error'] = "ERROR::DB operation failed.";
    $response['db_error'] = $conn->error;
   	echo json_encode($response);
}
$conn->close();

exit();
?>