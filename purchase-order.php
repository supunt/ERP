<?php require('header.php'); ?>
<?php require('classes/db.php'); ?>

<title>
<HEAD>Purchase order Entry</HEAD>

</title>
<script type="text/javascript">
	
	//--------------------------------------------------------------------
	function setOrderID(orid){
		clearTable('itemtable');
		$.post('classes/fetchOrder.php', { oid: orid}).done(function(jsonResult) {
		    var obj = JSON.parse(jsonResult);
		    if (obj.fetchSuccess)	 
		    {
		    	document.getElementById('orderId').value = obj.oid;
		    	document.getElementById('vendorDropDown').value = obj.vid;
		    	document.getElementById('warehousecode').value = obj.warehousecode;
		    	onChangeVendor(obj.vid);
		    	loadTable(obj.oid);
		    } 
		    else
		    {
		    	clearOrderHeader(true);
		    	alert(obj.errorMsg);
		    }
		    
		});
	};
	
	//--------------------------------------------------------------------
	function onChangeVendor(vid)
	{
		var vendorList = document.getElementById('vendorDropDown');
		var vid = vendorList.options[vendorList.selectedIndex].value;

		if (vid == -1)
		{
			clearOrderHeader();
			return;
		}
		else
			$.post('classes/fetchVendor.php', { vendorID: vid}).done(function(jsonResult) {
		    var obj = JSON.parse(jsonResult);
		    if (obj.fetchSuccess)
		    {
		    	document.getElementById('description').value = obj.description;
		    	document.getElementById('address1').value = obj.address1;
		    	document.getElementById('address2').value = obj.address2;
		    	document.getElementById('suburb').value = obj.suburb;
		    	document.getElementById('state').value = obj.state;
		    	document.getElementById('postcode').value = obj.postcode;
		    	document.getElementById('country').value = obj.country;
		    }
		    else
		    {
		    	alert(obj.errorMsg);
		    }
		});
	}
	function clearOrderHeader(afterOrder=false)
	{
		if (afterOrder && document.getElementById('orderId'))
			document.getElementById('orderId').value = "";

		document.getElementById('vendorDropDown').value = -1;
		document.getElementById('description').value = "";
    	document.getElementById('address1').value = "";
    	document.getElementById('address2').value = "";
    	document.getElementById('suburb').value = "";
    	document.getElementById('state').value = "";
    	document.getElementById('postcode').value = "";
    	document.getElementById('country').value = "";
    	document.getElementById('warehousecode').value = "-1";
	}
	//--------------------------------------------------------------------
	function onChangeItemList()
	{
		var e = document.getElementById("itemList");
		if (e.options[e.selectedIndex].value != -1)
		{	
			var upElem = document.getElementById('unitPrice');
			upElem.value = e.options[e.selectedIndex].value;
		}
		resetHighlightColor('itemList');
	};
	//--------------------------------------------------------------------
	function editSelected()
	{
		var table = document.getElementById('itemtable');
		var rowCount = table.rows.length;
		if (table.rows[0].cells[0].childNodes[0].checked && (rowCount > 2))
		{
			alert('Select a single entry');
			return;
		}
		var count = 0;
		var selectedRow = 0;
        for(var i=1; i < rowCount; i++) {
        	if (table.rows[i].cells[0].childNodes[0].checked)
        	{
        		selectedRow = i;
        		count++;
        	}
        	if (count > 1)
        	{
        		alert('Select a single entry');
        		return;
        	}
        }   
        if (count == 0)
        {
        	alert('Select an entry');
        		return;
        }
        var Er = document.getElementById('editingRow');
        var addBtn = document.getElementById('btnAddItem');
        Er.value = selectedRow;

        var e = document.getElementById("itemList");

        var opts = e.options;
		for (var opt, j = 0; opt = opts[j]; j++) {
			if (opt.id == table.rows[selectedRow].cells[2].innerHTML) {
				  e.selectedIndex = j;
				  break;
				}
		}
		onChangeItemList();

		var qty = document.getElementById("itemQuantity");
        qty.value = table.rows[selectedRow].cells[3].innerHTML;

      	var ird = document.getElementById("itemReqDate");
        ird.value = table.rows[selectedRow].cells[6].innerHTML;
        


        addBtn.hidden = true;

        var updateBtn = document.getElementById("updateBtn");
        updateBtn.hidden = false;
        

        var cancelBtn = document.getElementById("cancelBtn");
        cancelBtn.hidden = false;
	}
	//--------------------------------------------------------------------
	function updateRow()
	{
		var updateBtn = document.getElementById("updateBtn");
        updateBtn.hidden = true;

        var cancelBtn = document.getElementById("cancelBtn");
        cancelBtn.hidden = true;

        var addBtn = document.getElementById('btnAddItem');
        addBtn.hidden = false;

        var Er = document.getElementById('editingRow');
        var row = Er.value;

        var table = document.getElementById('itemtable');

        var qty = document.getElementById("itemQuantity");
        table.rows[row].cells[3].innerHTML = qty.value;

      	var ird = document.getElementById("itemReqDate");
        table.rows[row].cells[6].innerHTML = ird.value;

        table.rows[row].cells[5].innerHTML = parseFloat(table.rows[row].cells[3].innerHTML) * parseFloat(table.rows[row].cells[4].innerHTML);
        clearItemEntry();
	}
	//--------------------------------------------------------------------
	function cancelUpdate()
	{
		var updateBtn = document.getElementById("updateBtn");
        updateBtn.hidden = true;

        var cancelBtn = document.getElementById("cancelBtn");
        cancelBtn.hidden = true;

        var addBtn = document.getElementById('btnAddItem');
        addBtn.hidden = false;
        clearItemEntry();
	}
	//--------------------------------------------------------------------
	function addRow(dataTable){
		var table = document.getElementById(dataTable);
		resetHighlightColor("itemList");
		var e = document.getElementById("itemList");
		
		swapBulkSelectionState(dataTable,true);

		if (e.options[e.selectedIndex].value == -1)
		{			
			swapHighlightColor("itemList");	
			alert("Please correct highlighted errors");		
			return;
		}

		if (document.getElementById("itemQuantity").value == '')
		{
			swapHighlightColor("itemQuantity");
			alert("Please correct highlighted errors");
			return;
		}


		for (var i = 1; i < table.rows.length; i++) {
			var row = table.rows[i];
			if (row.cells[2].innerHTML  == e.options[e.selectedIndex].id)
			{
				alert("Item already exist in list at row "+i);
				clearItemEntry();
				return;
			}
		}

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var chk = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name="chkbox[]";
        chk.appendChild(element1);

        var partName = row.insertCell(1);
        partName.innerHTML = e.options[e.selectedIndex].text;

        var partNoCell = row.insertCell(2);
        partNoCell.innerHTML = e.options[e.selectedIndex].id;

        var qtyCell = row.insertCell(3);
        qtyCell.innerHTML = document.getElementById("itemQuantity").value;

        var priceCell = row.insertCell(4);
        priceCell.innerHTML = parseFloat(document.getElementById("unitPrice").value);

        var subTotCell = row.insertCell(5);
        subTotCell.innerHTML = parseFloat(document.getElementById("unitPrice").value) * parseFloat(row.cells[3].innerHTML);

        var dateCell = row.insertCell(6);
        dateCell.innerHTML = document.getElementById("itemReqDate").value;
        clearItemEntry();
	};
	//--------------------------------------------------------------------
	function clearItemEntry()
	{
		document.getElementById("unitPrice").value = '';
		document.getElementById("itemQuantity").value = '';
		document.getElementById("itemReqDate").value = '<?php echo date('Y-m-d');?>';
		
		var e = document.getElementById("itemList");

        var opts = e.options;
		for (var opt, j = 0; opt = opts[j]; j++) {
			if (opt.value == -1) {
				  e.selectedIndex = j;
				  break;
				}
		}
		onChangeItemList();
	}
	//--------------------------------------------------------------------
	function swapBulkSelectionState(tableName,resetHeader)
	{
		var table = document.getElementById(tableName);
		

		if (resetHeader)
			table.rows[0].cells[0].childNodes[0].checked = false;

		var selectAll = table.rows[0].cells[0].childNodes[0].checked;
		var rowCount = table.rows.length;

		if (selectAll)
		{
			 for(var i=1; i < rowCount; i++)
            	table.rows[i].cells[0].childNodes[0].checked = true;
		}
		else
		{
			for(var i=1; i < rowCount; i++)
				table.rows[i].cells[0].childNodes[0].checked = false;
		}
	}
	//--------------------------------------------------------------------
	function deleteRows(dataTable){
	 	var table = document.getElementById(dataTable);
        var rowCount = table.rows.length;
        for(var i=1; i < rowCount; i++) {
        	row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
        	if (null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
            }
        }

        swapBulkSelectionState(dataTable,true);
	};
	//--------------------------------------------------------------------
	function clearTable(dataTable){
	 	var table = document.getElementById(dataTable);
        var rowCount = table.rows.length;
        for(var i=1; i < rowCount; i++) {
            table.deleteRow(i);
            rowCount--;
            i--;
        }

        swapBulkSelectionState(dataTable,true);
	};
	//--------------------------------------------------------------------
	function swapHighlightColor(controlId)
	{
		var elem = document.getElementById(controlId);
		if (elem && elem.style.backgroundColor == "#FF8263")
		{
			elem.style.backgroundColor = "#000000";
		}
		else
		{
			elem.style.backgroundColor = "#FF8263";
		}
	};
	//--------------------------------------------------------------------
	function resetHighlightColor(controlId)
	{
		var elem = document.getElementById(controlId);
		if (elem)
			elem.style.backgroundColor = "#ffffff";
	}
	//--------------------------------------------------------------------
	function loadTable(orderId)
	{
		$.post('classes/loadOrderItems.php', 
				{oid : orderId}).done(
					function(jsonResult) 
					{
						var response;
						 try {
						 	response = JSON.parse(jsonResult);
						 } catch(e) {
						 	console.log(e + "Json str :\n"+jsonResult);
						 	return;
						 }
						if (response.is_error)
							alert("Error::"+(update?"Update":"Insert")+" failed : "+response.error);
						else
						{
							var table = document.getElementById('itemtable');
							var array = response.data;
							for (var row in array)
							{
						        var rowCount = table.rows.length;
						        var tr = table.insertRow(rowCount);

						        var chk = tr.insertCell(0);
						        var element1 = document.createElement("input");
						        element1.type = "checkbox";
						        element1.name="chkbox[]";
						        chk.appendChild(element1);

						        var partName = tr.insertCell(1);
						        partName.innerHTML = array[row].partname; // problem

						        var partNoCell = tr.insertCell(2);
						        partNoCell.innerHTML = array[row].partnumber;

						        var qtyCell = tr.insertCell(3);
						        qtyCell.innerHTML = array[row].quantity;

						        var priceCell = tr.insertCell(4);
						        priceCell.innerHTML = array[row].price;

						        var subTotCell = tr.insertCell(5);
						        subTotCell.innerHTML = array[row].cost;

						        var dateCell = tr.insertCell(6);
						        dateCell.innerHTML = array[row].duedate;	
						    }
						}
					});

	}
	//--------------------------------------------------------------------
	function saveOrderHeaderThenDetails(update)
	{
		var uId = -1;
		var jsonObj;
		var vendorList = document.getElementById('vendorDropDown');
		var warehouse = document.getElementById('warehousecode');

		if (!update)
		{
			jsonObj = {
				vid : vendorList.options[vendorList.selectedIndex].value,
				wid : warehouse.options[warehouse.selectedIndex].value,
				action : 'add'
			}	
		}
		else
		{
			var orderID = document.getElementById('orderId').value;
			jsonObj = {
				orderId : orderID,
				vid : vendorList.options[vendorList.selectedIndex].value,
				wid : warehouse.options[warehouse.selectedIndex].value,
				action : 'update'
			}	

		}
		$.post('classes/purchaseorderMaster.php', 
				jsonObj).done(
					function(jsonResult) 
					{
						var response;
						 try {
						 	response = JSON.parse(jsonResult);
						 } catch(e) {
						 	console.log(e);
						 	return;
						 }
						if (response.is_error)
						{
							alert("Error::"+(update?"Update":"Insert")+" failed : "+response.error);
							console.log(response.db_error);
						}
						else
						{
							var orderId = response.row_num;
							if (update)
								orderId = document.getElementById('orderId').value;

							saveOrderDetails(update,orderId);
						}
					}
				);
	}
	//--------------------------------------------------------------------
	function saveOrderDetails(update,orderId)
	{
		// purchaselistdelete post bulk delete
		// post bulk insert
		$.post('classes/purchaselistdelete.php', 
				{oid : orderId, action : 'delete'}).done(
					function(jsonResult) 
					{
						var response;
						 try {
						 	response = JSON.parse(jsonResult);
						 } catch(e) {
						 	console.log(e);
						 	return;
						 }
						if (response.is_error)
						{
							alert("Error::Order deletion failed : "+response.error);
							console.log(response.db_error);
							return;
						}
					}
				);
		
		// not the best implementation
		var table = document.getElementById('itemtable');
        var rowCount = table.rows.length;
        var saveSuccess = true;
        for(var i=1; i < rowCount; i++) {

        	var row = table.rows[i];
        	var index = i-1;

        	var json_table_row = {
        		action : 'add',
        		oid : orderId,
        		podid : index,
        		partnumber :  table.rows[i].cells[2].innerHTML,
        		location : '',
        		quantity :  table.rows[i].cells[3].innerHTML,
        		cost :  table.rows[i].cells[5].innerHTML,
        		duedate : table.rows[i].cells[6].innerHTML
        	};
        	$.post('classes/purchaselistMaster.php', 
				json_table_row).done(
					function(jsonResult) 
					{
						var response;
						 try {
						 	response = JSON.parse(jsonResult);
						 } catch(e) {
						 	console.log(e);
						 	return;
						 }
						if (response.is_error)
						{
							saveSuccess = false;
							alert("Error::Order detail insert failed : "+response.error);
							console.log(response.db_error);
							// ROLL BACK ENTIRE ORDER TODO
							return;
						}
						else
						{
							
						}
					}
				);
        }

		if (saveSuccess)
		{
			alert("Order saved successfully. [ID - "+ orderId + "]");
			if (update)
				window.location.href = "purchase-order.php?manipulate=true&orderId="+orderId;
			else
				window.location.href = "purchase-order.php";
		}
	}
	//--------------------------------------------------------------------
	function saveOrder(update)
	{
		var vendorList = document.getElementById('vendorDropDown');
		var warehouse = document.getElementById('warehousecode');

		var table = document.getElementById('itemtable');
		if (table.rows.length == 1)
			if(confirm("This order has no items. Do you want to continue ?") == false)
				return;

		if (vendorList.options[vendorList.selectedIndex].value == -1)
		{
			alert("Vendor not selected");
			return;
		}
		if (warehouse.options[warehouse.selectedIndex].value == -1)
		{
			alert("Warehouse not selected");
			return;
		}

		saveOrderHeaderThenDetails(update);

	}
	//--------------------------------------------------------------------
	function updateOrder() {
		saveOrder(true);
	}
	//--------------------------------------------------------------------
	function deleteOrder(){
		if(confirm("Are you sure you want to delete this order ?") == false)
			return;

		var orderID = document.getElementById('orderId').value;
		var	jsonObj = {
				orderId : orderID,
				action : 'delete'
			};	

		$.post('classes/purchaseorderMaster.php', 
				jsonObj).done(
					function(jsonResult) 
					{
						var response = JSON.parse(jsonResult);
						if (response.is_error)
							alert("Error::Order deletion failed : "+response.error);
						else
						{
							alert("Order deleted successfully.");
						}
					}
				);
	}
	//--------------------------------------------------------------------
</script>

<div class="container">
<?php require('topNav.php'); ?>
<div class="vendorMasForm">
<form>
		<?php if (isset($_GET['manipulate'])){ ?>
			<div class="title">Order ID  : </div>
			<div class="input"><input name="orderId" id="orderId" type="number" onChange="setOrderID(this.value)"/></div> 
		<?php } ?>		

        <div class="title">Vendor : </div>
		<div class="input">
			<select name="vendorDropDown" id="vendorDropDown" onChange="onChangeVendor(this.value)">
			<option value="-1"> Select Vendor </opiton>
				<?php 
					$allVendorsSql = "SELECT id,vname FROM vendermaster order by Id asc";
					$vendorResult = $conn->query($allVendorsSql);

					if ($vendorResult->num_rows > 0) {
					  	while($row = $vendorResult->fetch_assoc()) {
					  		$selected  = "";
					  		if(ISSET($_GET['vid']) && $_GET['vid'] == $row['id'])
									$selected = 'selected';	
							
				?>
				<option <?php echo $selected; ?> value="<?php echo $row['id'];?>"><?php echo $row['vname'];?></opiton>	
				<?php } } ?>

			</select>
        <input type="hidden" name="vid" value="<?php echo $_GET['vid'] ?>" />
		</div>
	
    <div class="title">Description : </div>
	<div class="input"><textarea id="description" readonly=true></textarea></div>

	<div class="title">Address 1 : </div>
	<div class="input"><textarea id="address1" readonly=true></textarea></div>

	<div class="title">Address 2 : </div>
	<div class="input" ><textarea id="address2" readonly=true></textarea></div>

	<div class="title">Suburb  : </div>
	<div class="input" id="suburb"><input type="text" readonly=true /></div>

	<div class="title">State  : </div>
	<div class="input"><input id="state" type="text" readonly=true  /></div>   

	<div class="title">Post code  : </div>
	<div class="input"><input id="postcode" type="text" readonly=true  /></div> 

	<div class="title">Country   : </div>
	<div class="input"><input id="country" type="text" readonly=true /></div> 
    		
	<div class="title">Warehouse code : </div>
	<div class="input">
		<select id="warehousecode">
			<option selected value="-1" >select warehouse</opiton>
			<?php foreach($jsonData['warehousecode'] as $key => $val) { 
							
			?>
			<option <?php echo $selected; ?> value="<?php echo $key; ?>" ><?php echo $val; ?></opiton>
			<?php } ?>
		</select>		
	</div>
	
<div></div>
<hr>

<h3> Order Items</h3>

<div class="OrderItems">
		
        <div class="gridhedder">
        <div class="tithed">Item : </div>
        <div class="tithed">Unit Price : </div>
        <div class="tithed">Quantity : </div>
        <div class="tithed">Required by : </div>
        <div class="tithed"></div>
        </div>
        <div class="gridcontent">
        <div class="titcon">
			<select id="itemList" onChange="onChangeItemList()">
				<option value="-1" selected> Select Item </opiton>
				<?php
					$sql = "select id,itemname,cost from items";
					$cur = $conn->query($sql);

					if ($cur->num_rows > 0) {
						while($row = $cur->fetch_assoc()) {
					?>
						<option id="<?php echo $row['id'] ?>" value="<?php echo $row['cost'] ?>"> <?php echo $row['itemname'] ?> </option>;
					<?php }};
				?>
				
			</select>
		</div>
        <div class="titcon"><input id="unitPrice"  value="" /></div>
        <div class="titcon"><input id="itemQuantity" onChange="resetHighlightColor('itemQuantity')" type="text"/></div>
        <div class="titcon"><input id="itemReqDate" type="date" value='<?php echo date('Y-m-d');?>'  /></div>
        <div><input id="editingRow" type="hidden" value="-1"/></div> 
        <div class="titcon">
        <div id="buttionBox">
			<input type="button" value="Add Item" id="btnAddItem" onClick="addRow('itemtable')" />
			<input type="button" value="Update" id="updateBtn" onClick="updateRow()" hidden="true" />
			<input type="button" value="Cancel" id="cancelBtn" onClick="cancelUpdate()" hidden="true"/>
		</div>
        </div>
        </div>
	</div>	
	    <table id="itemtable" border="1">
			<tr>
				<th><input type="checkbox" name="hdrchkbox" onClick="swapBulkSelectionState('itemtable',false)" /></th>  
				<th>Part name</th> 
				<th>Part number</th>
				<th>Quantity</th> 
				<th type="number">Price</th>
				<th type="number">Sub Total</th>
				<th>Due date</th>
			</tr>
	    </table>
        <div class="gridbtnbot1">
	    <br>
	    <input type="button" value="Delete selected" onClick="deleteRows('itemtable')" />
	    <input type="button" name="editBtn" value="Edit selected Entry" onClick="editSelected()" />
	    <br>
	    </div>
	    <div class="gridbtnbot2"> 
    	<?php if(!ISSET($_GET['manipulate'])) {?>  
	    	<input type="button" name="btnAdd" value="Save" onClick="saveOrder(false)" /> 
	    <?php }  
    	else
    	{ ?>
    		<input type="button" name="btnUpdate" value="Update" onClick="updateOrder()"/>
    		<input type="button" name="btnDelete" value="Delete" onClick="deleteOrder()"/>
    		
    	<?php } ?>
    </div>
	 
	</form>

	<?php if(isset($_GET['orderId'])) { ?>
		<script type="text/javascript">
			setOrderID(<?php echo $_GET['orderId'] ?>);
		</script>
				
	<?php } ?>
</div>
</div>




