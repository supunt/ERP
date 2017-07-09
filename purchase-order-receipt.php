<?php require('header.php'); ?>
<?php require('classes/db.php'); ?>
<?php 
$method = 'add';
$id = '';
$alldata = "SELECT * FROM purchaseorder order by id desc";
$result = $conn->query($alldata);


if($_GET['mode'] == 'new') {
	$method = 'add';
	$id = $_GET['id'];
	$rowData = "SELECT * FROM vendermaster where id=". $id;
	$rowResult = $conn->query($rowData);
	if($rowResult->num_rows == 0) {
		echo "There is no data for this ID. Please contact administrator.";die();
	}
	$updaterow = mysqli_fetch_assoc($rowResult);

}


//Select all Vendors
$vendors = "SELECT id, description FROM vendermaster order by Id asc";
$vendorResult = $conn->query($vendors);



?>

<div class="container">
	<?php require('topNav.php'); ?>
<div class="vendorMasForm">
<form action="purchase-order-receipt2.php" method="POST" >
<div class="row">
            <div class="title">Transaction Type  : </div>
<div class="input">
<select name="location" id="location">
	<option value="Transaction Type 01">Transaction Type 01</option>
    <option value="Transaction Type 02">Transaction Type 02</option>
    <option value="Transaction Type 03">Transaction Type 03</option>
</select>
</div>
</div>

<div class="row">
            <div class="title">Transaction Description   : </div>
<div class="input">
<select name="location" id="location">
	<option value="Transaction Description  01">Transaction Description  01</option>
    <option value="Transaction Description  02">Transaction Description  02</option>
    <option value="Transaction Description  03">Transaction Description  03</option>
</select>
</div>
</div>


<div class="row">
            <div class="title">Primary Vendor Number: </div>
			<div class="input"><select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
			<option value="" > Select V ID </opiton>
						<?php if ($vendorResult->num_rows > 0) {
						  	while($row = $vendorResult->fetch_assoc()) {					
							$selected = '';
							if($_GET['mode'] == 'new') {
							$selected = 'selected';
							}
						?>
						<option <?php echo $selected; ?> value="purchase-order-receipt.php?mode=new&id=<?php echo $row['id']; ?>" ><?php echo $row['id']." - "; echo "VN"; ?></opiton>
						<?php } } ?>
					</select>
                    <input type="hidden" name="vid" value="<?php echo $_GET['id'] ?>" />
</div>
            
				<div class="title">Description : </div>
				<div class="input"><textarea name="description" <?php  echo ($_GET['method'] == 'new' ? "readonly" : ''); ?> ><?php  echo ($_GET['method'] == 'new' ? $updaterow['description'] : ''); ?></textarea></div>
                 

				<div class="title">Purchase order Number</div>
				<div class="input"><select name="pono" id="pono">
                <option value="" >--- </opiton>
                <?php
				$po = "SELECT pid FROM purchaseorder order by pid asc";
				$poResult = $conn->query($po);
				if ($poResult->num_rows > 0) { 
				while($row = $poResult->fetch_assoc()) 
				{	
				?>
				
                <option value="purchase-order-list.php?action=update&mode=update&id=<?php echo $row['pid']; ?>" > <?php echo $row['pid']; ?> </opiton>
                        
				<?php } }  ?>
				</select>
                    
</div>



				<div class="title">Warehouse code </div>
				<div class="input">
					<select name="warehousecode" >
						<?php foreach($jsonData['warehousecode'] as $key => $val) { 
							$selected = '';
							if($_GET['mode'] == 'new' && $key == $updaterow['warehousecode']) {
								$selected = 'selected';
							}
						?>
						<option <?php echo $selected; ?> value="<?php echo $key; ?>" ><?php echo $val; ?></opiton>
						<?php } ?>
					</select>
    				
				</div>
            
                
               

				<div class="title">&nbsp;</div>
				<div class="input"><input type="submit" value="View" ></div>


</div>

</form>

</div>
</div>