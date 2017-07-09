<?php 
	require('db.php');

	if (!isset($_POST['oid']))
		return;

	$sql = "SELECT pid,vendorno,warehousecode FROM purchaseorder where pid =".$_POST['oid'];
	$cursor = $conn->query($sql);

	$arrResults = [];

	if ($cursor->num_rows > 0)
	{
		$row = $cursor->fetch_assoc();
		$arrResults['oid'] = $row['pid'];
		$arrResults['vid'] = $row['vendorno'];
		$arrResults['warehousecode'] = $row['warehousecode'];
		$arrResults['fetchSuccess'] = true;

	}
	else
	{
		$arrResults['fetchSuccess'] = false;
		$arrResults['errorMsg'] = "Order id '".$_POST['oid']."'' is invalid";
	}
	

	echo json_encode($arrResults);			
?>