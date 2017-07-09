<?php 
	require('db.php');

	if (!isset($_POST['vendorID']))
	{
		$arrResults['fetchSuccess'] = false;
		$arrResults['errorMsg'] = "invalid action attempted.";
		echo json_encode($arrResults);	
		return;
	}

	$sql = "SELECT * FROM vendermaster where id =".$_POST['vendorID'];
	$cursor = $conn->query($sql);

	$arrResults = [];

	if ($cursor->num_rows > 0)
	{
		$row = $cursor->fetch_assoc();
		$arrResults['id'] = $row['id'];
		$arrResults['description'] = $row['description'];
		$arrResults['address1'] = $row['address1'];
		$arrResults['address2'] = $row['address2'];
		$arrResults['suburb'] = $row['suburb'];
		$arrResults['state'] = $row['state'];
		$arrResults['postcode'] = $row['postcode'];
		$arrResults['country'] = $row['country'];
		$arrResults['fetchSuccess'] = true;

	}
	else
	{
		$arrResults['fetchSuccess'] = false;
		$arrResults['errorMsg'] = "Order id '".$_POST['oid']."'' is invalid";
	}
	

	echo json_encode($arrResults);			
?>