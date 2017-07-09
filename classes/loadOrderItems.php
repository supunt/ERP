<?php 
require('db.php');

if(!isset($_POST['oid'])) {
	$response['is_error'] = true;
	$response['error'] = "Error::Invalid action (Order ID)";
	echo json_encode($response);
	return;
}

$oid = $_POST['oid'];
if($oid == '') {
	$response['is_error'] = true;
	$response['error'] = "Error::Invalid action, (Order ID), [Category 2]";
	echo json_encode($response);
	return;
}

$sql = "SELECT  purchaseorderetails.podid as podid,"
				."purchaseorderetails.partnumber as partnumber,"
				."purchaseorderetails.quantity as quantity,"
				."purchaseorderetails.cost as cost,"
				."purchaseorderetails.duedate as duedate,"
				."items.itemname as partname,"
				."items.listPrice as price FROM purchaseorderetails inner join items ON purchaseorderetails.partnumber = items.id WHERE purchaseorderetails.pid=". $oid;

$cursor = $conn->query($sql);
$dataArray = array();
if ($cursor->num_rows > 0)
{
	
	$index = 0;

	while ($row = $cursor->fetch_assoc())
	{
		$dataArray[] = $row;
	}

	$response['is_error'] = false;
	$response['data'] = $dataArray;
	echo json_encode($response,JSON_FORCE_OBJECT);
	return;
}
else
{
	$response['is_error'] = false;
	$response['data'] = $dataArray;
	echo json_encode($response,JSON_FORCE_OBJECT);
	return;
}

$conn->close();
?>