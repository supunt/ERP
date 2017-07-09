<?php require('header.php'); ?>
<?php require('classes/db.php'); ?>

<?php 
$pid=$_GET['pid'];
if($_GET['pid'] == '') {
	$method = 'add';
	$po = "SELECT * FROM purchaseorder order by pid DESC LIMIT 1";
	$poResult = $conn->query($po);
	if ($poResult->num_rows > 0) { 
	while($row = $poResult->fetch_assoc()) {
	$vno= $row['vendorno'];
	$whcode= $row['warehousecode'];
	$pid= $row['pid'];
	}}
	}
	
else {
	$method = 'add';
	$po = "SELECT * FROM purchaseorder where pid=". $pid;
	$poResult = $conn->query($po);
	if ($poResult->num_rows > 0) { 
	while($row = $poResult->fetch_assoc()) {
	$vno= $row['vendorno'];
	$whcode= $row['warehousecode'];
	$pid= $row['pid'];
	}}
	}
	
//Select all Vendors
$item = "SELECT id, itemname  FROM  items order by id asc";
$itemResult = $conn->query($item);

?>

<div class="container">
<?php require('topNav.php'); ?>
<body>    
<div class="vendorMasForm">
<form action="classes/purchaselistMaster.php" method="POST" >

<div class="row">

<?php 
$vendors = "SELECT * FROM vendermaster where id=". $vno;
$vendorResult = $conn->query($vendors);
if ($vendorResult->num_rows > 0) { 
while($row = $vendorResult->fetch_assoc()) 
{			
?>
            	<div class="title">Primary Vendor Number: </div>
				<div class="input">	<?php echo $row['vname']; ?></div>
           
				<div class="title">Description : </div>
				<div class="input"><?php echo $row['description']; ?> </div>
                <div class="title">Address 1 : </div>
				<div class="input"><?php echo $row['address1']; ?></div>
                
                <div class="title">Address 2 : </div>
				<div class="input"><?php echo $row['address2']; ?></div>
				 <div class="title">Suburb  : </div>
                 
				<div class="input"><?php echo $row['suburb']; ?></div>
                <div class="title">State  : </div>
				<div class="input"><?php echo $row['state']; ?></div>                
                <div class="title">Post code  : </div>
                <div class="input"><?php echo $row['postcode']; ?></div> 
                
                <div class="title">Country   : </div>
              	<div class="input"><?php echo $row['country']; ?></div> 
<?php  }} ?>

</div>

<div class="row">
			<div class="title"> Warehouse code </div>
            <div class="input"> <?php  echo $whcode; ?> </div>
</div>
<div class="delrow">
<div class="gsectionh">Partnumber</div> 
<div class="gsectionh">Quantity</div> 
<div class="gsectionh">Requested Qty  </div> 
<div class="gsectionh">Recept  quantity </div>
<div class="gsectionh">Recept   Date</div>   
<div class="gsectionbtn">&nbsp;</div>   
</div>
<div class="delrow">
<?php 
$vendors = "SELECT * FROM purchaseorderetails where pid=". $pid;
$vendorResult = $conn->query($vendors);
if ($vendorResult->num_rows > 0) { 
while($row = $vendorResult->fetch_assoc()) 
{			
?>
<div class="gsection"><?php echo $row['partnumber']; ?></div>
<div class="gsection"><?php echo $row['quantity']; ?></div>
<div class="gsection"><input value="" name="quantity" /></div>
<div class="gsection"><input value="" name="quantity" /></div>
<div class="gsection"><?php echo $row['duedate']; ?></div>
<div class="gsectionbtn"><a href="#" onClick="return confirm('Are you sure?')" class="delete" >Update </a></div>
<?php  }} ?>
</div>


                    
                    
           

			
<input type="hidden" name="formMethod" value="<?php echo $method; ?>" />
<input type="hidden" name="pid" value="<?php echo $pid; ?>" />
</form>
</div>

</div>
</body>
