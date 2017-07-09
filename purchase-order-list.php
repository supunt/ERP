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
<div class="vendorMasForm2">
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
<div class="gsectionh">Location</div> 
<div class="gsectionh">Quantity</div> 
<div class="gsectionh">Cost</div> 
<div class="gsectionh">Due Date</div>   
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
<div class="gsection"><?php echo $row['location']; ?></div>
<div class="gsection"><?php echo $row['quantity']; ?></div>
<div class="gsection"><?php echo $row['cost']; ?></div>
<div class="gsection"><?php echo $row['duedate']; ?></div>
<div class="gsectionbtn"><a href="classes/purchaselistMaster.php?action=delete&id=<?php echo $row['podid']; ?>" onClick="return confirm('Are you sure?')" class="delete" >Delete </a></div>
<?php  }} ?>
</div>

<div class="delrow">
<div class="gsection"><select name="partnumber" >
						<?php if ($itemResult->num_rows > 0) { 
						  	while($row = $itemResult->fetch_assoc()) {
						?>
						<option <?php echo $selected; ?> value="<?php echo $row['id']; ?>" ><?php echo $row['itemname']; ?>-<?php echo $row['id']; ?></opiton>
						<?php } } ?>
					</select></div>
                    
                    
           
<div class="gsection">
<select name="location" id="location">
	<option value="Location 01">Location 01</option>
    <option value="Location 02">Location 02</option>
    <option value="Location 03">Location 03</option>
</select></div>
<div class="gsection"> <input type="text" name="quantity" /> </div>
<div class="gsection"> <input type="text" name="cost" /> </div>
<div class="gsection"> <input type="text" name="duedate" /> </div>
<div class="gsectionbtn"> <input type="submit" value="Add New" width="50px" > </div>
</div>
			
<input type="hidden" name="formMethod" value="<?php echo $method; ?>" />
<input type="hidden" name="pid" value="<?php echo $pid; ?>" />
</form>
</div>

</div>
</body>
