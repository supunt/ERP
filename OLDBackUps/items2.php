<?php require('header.php'); ?>
<?php require('classes/db.php'); ?>
<?php 
$method = 'add';
$id = '';
$itemname="";
$alldata = "SELECT * FROM items order by Id desc";
$result = $conn->query($alldata);

//if(isset($_POST['submit']))
//{
	echo "Submitted";
	if($_GET['action'] == 'add') {
		$method = 'add';
		$itemname = $_GET['itemname'];
		if ($itemname != "")
		{
			$rowData = "SELECT * FROM items where itemname=". $itemname;
			$rowResult = $conn->query($rowData);
			if($rowResult->num_rows > 0) 
			{
			echo "Item name already exists.";die();
			}
		}
	}

	
	if($_GET['action'] == 'update') {
		$method = 'update';
		$id = $_GET['id'];
		$rowData = "SELECT * FROM items where Id=". $id;
			$rowResult = $conn->query($rowData);
			if($rowResult->num_rows == 0) {
			echo "There is no data for this ID. Please contact administrator.";die();
			}
			$updaterow = mysqli_fetch_assoc($rowResult);
	}

if($_GET['action'] == 'delete' ) {
	$method = 'delete';
	$id = $_GET['id'];
	$rowData = "SELECT * FROM items where Id=". $id;
	$rowResult = $conn->query($rowData);
	if($rowResult->num_rows == 0) {
		echo "There is no data for this ID. Please contact administrator.";die();
	}
	$updaterow = mysqli_fetch_assoc($rowResult);

}

//Select all Vendors
$vendors = "SELECT id, description FROM vendermaster order by Id asc";
$vendorResult = $conn->query($vendors);
//}
?>

<body>
<div class="container">
	<?php require('topNav.php'); ?>

	<div class="vendorMasForm">
		<h2>Item Maintenance</h2>
		<form action="classes/itemMaster.php" method="POST" >
        <div class="row">
		<div class="title">Mode</div>         
                
                <div class="input">
                <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
					<option value="items2.php?mode=add" <?php if($_GET['mode'] == 'add') {?> selected <?php } ?>>Add</option>
					<option value="items2.php?mode=view" <?php if($_GET['mode'] == 'view') {?> selected <?php } ?>>View</option>
					<option value="items2.php?mode=update" <?php if($_GET['mode'] == 'update') {?> selected <?php } ?>>Update</option>
					<option value="items2.php?mode=delete" <?php if($_GET['mode'] == 'delete') {?> selected <?php } ?>>Delete</option>
				</select>
                </div>
		</div>
        
        
		<div class="row">
				<div class="title">Part Name </div>
				<div class="input">
                <?php
                if($_GET['mode'] == 'add') {
				$method = 'add';
				?>
                <input name="itemname"><?php  echo ($_GET['action'] == 'update' ? $updaterow['itemname'] : ''); ?></input>
                <?php
				}
				
				if($_GET['mode'] == 'update') {
				$method = 'update';
				?>
				<select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">

				<option <?php echo $selected; ?> value="" ><?php echo $_GET['name'] ?></opiton>
						
						<?php if ($result->num_rows > 0) { 
						  	while($row = $result->fetch_assoc()) {						 
						
							$selected = '';
							if($_GET['action'] == 'update' && $row['id'] == $updaterow['vendorID']) {
							$selected = 'selected';
							}
						?>
						<option value="items2.php?action=update&mode=update&id=<?php echo $row['id']; ?>&name=<?php echo $row['itemname']; ?> " ><?php echo $row['itemname']; ?></opiton>
                        
						<?php } } ?>
					</select>
                    <input type="hidden" name="itemname" value="<?php echo $_GET['name'] ?>" />
                <?php
				}
				if($_GET['mode'] == '') {			
				?>
                <input name="itemname"><?php  echo ($_GET['action'] == 'update' ? $updaterow['itemname'] : ''); ?></input>
                <?php
	}
	
	if($_GET['mode'] == 'delete') {
				$method = 'delete';
				?>
<select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
<option <?php echo $selected; ?> value="" ><?php echo $_GET['name'] ?></opiton>
						<?php if ($result->num_rows > 0) { 
						  	while($row = $result->fetch_assoc()) {						 
						
							$selected = '';
							if($_GET['action'] == 'delete' && $row['id'] == $updaterow['vendorID']) {
								$selected = 'selected';
							}
						?>
						<option value="items2.php?action=delete&mode=delete&id=<?php echo $row['id']; ?>&name=<?php echo $row['itemname']; ?>" ><?php echo $row['itemname']; ?></opiton>
                        
						<?php } } ?>
					</select>
                    <input type="hidden" name="itemname" value="<?php echo $_GET['name'] ?>" />
                <?php
				}
				
				
	if($_GET['mode'] == 'view') {
				$method = 'delete';
				?>
<select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
<option <?php echo $selected; ?> value="" ><?php echo $_GET['name'] ?></opiton>
						<?php if ($result->num_rows > 0) { 
						  	while($row = $result->fetch_assoc()) {						 
						
							$selected = '';
							if($_GET['action'] == 'delete' && $row['id'] == $updaterow['vendorID']) {
								$selected = 'selected';
							}
						?>
						<option value="items2.php?action=delete&mode=view&id=<?php echo $row['id']; ?>&name=<?php echo $row['itemname']; ?>" ><?php echo $row['itemname']; ?></opiton>
                        
						<?php } } ?>
					</select>
                    <input type="hidden" name="itemname" value="<?php echo $_GET['name'] ?>" />
                <?php
				}			
				
				
				?>
</div>
		</div>
			<div class="row">
				<div class="title">Part Description : </div>
				<div class="input"><textarea name="description" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> ><?php  echo ($_GET['action'] == 'update' ? $updaterow['description'] : ''); ?><?php  echo ($_GET['action'] == 'delete' ? $updaterow['description'] : ''); ?></textarea></div>
				<div class="title">Extra Description: </div>
				<div class="input"><textarea name="extradescription" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> ><?php  echo ($_GET['action'] == 'update' ? $updaterow['extraDescription'] : ''); ?><?php  echo ($_GET['action'] == 'delete' ? $updaterow['extraDescription'] : ''); ?></textarea></div>
			</div>
			
			<div class="row">
				<div class="title">Purchasing UOM : </div>
				<div class="input">
                
                <?php if($_GET['action'] == 'delete') {?>
                <input name="purchasingUOM" type="text" value="<?php echo ($_GET['action'] == 'delete' ? $updaterow['purchasingUOM'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
                <?php }
				else{
				 ?>
                
                
                
					<select name="purchasingUOM" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?>>
						<?php foreach($jsonData['purchasingUOM'] as $key => $val) { 
							$selected = '';
							if($_GET['action'] == 'update' && $key == $updaterow['purchasingUOM']) {
								$selected = 'selected';
							}
						?>
						<option <?php echo $selected; ?> value="<?php echo $key; ?>" ><?php echo $val; ?></opiton>
						<?php } ?>
					</select>
                    
                   	<?php } ?>
				</div>
				<div class="title">Selling UOM: </div>
				<div class="input">
                <?php if($_GET['action'] == 'delete') {?>
                <input name="sellingUOM" type="text" value="<?php echo ($_GET['action'] == 'delete' ? $updaterow['sellingUOM'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
                <?php }
				else{
				 ?>
                
					<select name="sellingUOM" >
						<?php foreach($jsonData['sellingUOM'] as $key => $val) { 
							$selected = '';
							if($_GET['action'] == 'update' && $key == $updaterow['sellingUOM']) {
								$selected = 'selected';
							}
						?>
						<option <?php echo $selected; ?> value="<?php echo $key; ?>" ><?php echo $val; ?></opiton>
						<?php } ?>
					</select>
                    <?php } ?>
				</div>
			</div>
			
			<div class="row">
				<div class="title">Stocking UOM: </div>
				<div class="input">
                 <?php if($_GET['action'] == 'delete') {?>
                <input name="stockingUOM" type="text" value="<?php echo ($_GET['action'] == 'delete' ? $updaterow['stockingUOM'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
                <?php }
				else{
				 ?>
					<select name="stockingUOM" >
						<?php foreach($jsonData['stockingUOM'] as $key => $val) { 
							$selected = '';
							if($_GET['action'] == 'update' && $key == $updaterow['stockingUOM']) {
								$selected = 'selected';
							}
						?>
						<option <?php echo $selected; ?> value="<?php echo $key; ?>" ><?php echo $val; ?></opiton>
						<?php } ?>
					</select>
                    
                    	<?php } ?>
				</div>
				<div class="title">Drawing Number: </div>
                
                
				<div class="input"><input name="drawingNumber" type="text" value="<?php echo ($_GET['action'] == 'update' ? $updaterow['drawingNumber'] : ''); ?><?php echo ($_GET['action'] == 'delete' ? $updaterow['drawingNumber'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?>  /></div>
			</div>
			
			<div class="row">
				<div class="title">Cost: </div>
				<div class="input"><input name="cost" type="text" value="<?php echo ($_GET['action'] == 'update' ? $updaterow['cost'] : ''); ?><?php echo ($_GET['action'] == 'delete' ? $updaterow['cost'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> /></div>
				<div class="title">List Price: </div>
				<div class="input">
					<input name="listPrice" type="text" value="<?php echo ($_GET['action'] == 'update' ? $updaterow['listPrice'] : ''); ?><?php echo ($_GET['action'] == 'delete' ? $updaterow['listPrice'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
				</div>
                <div class="title">Minimum Balance: </div>
				<div class="input">
					<input name="minbalance" type="text" value="<?php echo ($_GET['action'] == 'update' ? $updaterow['minbalance'] : ''); ?><?php echo ($_GET['action'] == 'delete' ? $updaterow['minbalance'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
				</div>
                
			</div>
			<div class="row">
				<div class="title">Lead Time: </div>
				<div class="input"><input name="leadTime" type="text" value="<?php echo ($_GET['action'] == 'update' ? $updaterow['leadTime'] : ''); ?><?php echo ($_GET['action'] == 'delete' ? $updaterow['leadTime'] : ''); ?>"<?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> /></div>
				
				</div>

			<div class="row">
            <div class="title">Primary Vendor Number: </div>
				<div class="input"><select name="vendorID" >
						<?php if ($vendorResult->num_rows > 0) { 
						  	while($row = $vendorResult->fetch_assoc()) {
							 
						
							$selected = '';
							if($_GET['action'] == 'update' || $_GET['action'] == 'delete' && $row['id'] == $updaterow['vendorID']) {
								$selected = 'selected';
							}
						?>
						<option <?php echo $selected; ?> value="<?php echo $row['id']; ?>" ><?php echo $row['id']." - "; echo "VN"; ?></opiton>
						<?php } } ?>
					</select></div>
				<div class="title">ABC Code: </div>
				<div class="input">
					<input name="abcCode" type="text" value="<?php echo ($_GET['action'] == 'update' ? $updaterow['abcCode'] : ''); ?><?php echo ($_GET['action'] == 'delete' ? $updaterow['abcCode'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
				</div>
				
				
			</div>
			
			<div class="row">
				<div class="title">Extra Fields 1: </div>
				<div class="input"><input name="extraf1" type="text" value="<?php echo ($_GET['action'] == 'update' ? $updaterow['exfield1'] : ''); ?><?php echo ($_GET['action'] == 'delete' ? $updaterow['exfield1'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> /></div>
				<div class="title">Extra Fields 2: </div>
				<div class="input"><input name="extraf2" type="text" value="<?php echo ($_GET['action'] == 'update' ? $updaterow['exfield2'] : ''); ?><?php echo ($_GET['action'] == 'delete' ? $updaterow['exfield2'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> /></div>
			</div>
			
			<div class="row">
				<div class="title">Extra Fields 3: </div>
				<div class="input"><input name="extraf3" type="text" value="<?php echo ($_GET['action'] == 'update' ? $updaterow['exfield3'] : ''); ?><?php echo ($_GET['action'] == 'delete' ? $updaterow['exfield3'] : ''); ?>" <?php  echo ($_GET['action'] == 'delete' ? "readonly" : ''); ?> /></div>
			</div>
			<div class="row">
				<div class="title">&nbsp;</div>
				<div class="input"> 
               <?php if($_GET['mode'] == 'delete') {?>  <a href="classes/itemMaster.php?action=delete&id=<?php echo $_GET['id']; ?>" onClick="return confirm('Are you sure?')" class="delete" >Delete </a> <?php } ?>
               <?php if($_GET['action'] == 'update') {?>  <input type="submit" value="Update" > <?php } ?>
               <?php if($_GET['mode'] == 'add') {?>  <input type="submit" value="Add New" > <?php } ?>
               <?php if($_GET['mode'] == 'view') {?>   <?php } ?>
			 </div>
			</div>
			<input type="hidden" name="formMethod" value="<?php echo $method; ?>" />
			<input type="hidden" name="itemID" value="<?php echo $id; ?>" />
		</form>
	</div>

</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/custom.js"></script>
<?php require('footer.php'); ?>
</body>
</html>