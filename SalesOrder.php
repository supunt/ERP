<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SOS</title>
<link rel="stylesheet" type="text/css" href="css/styleSO.css">

</head>

<body>
<div class="wrapper">
<div class="contaner">
<div class="sosheader">
<div class="rowh">
<div class="htitle">Mode</div>
<div class="hinput">
	<select>
      <option>Add</option>
      <option>Update</option>
      <option>Delete</option>
      <option>Display</option>
    </select></div>
</div>
<div class="row">
<div class="htitle">Order Number</div>
<div class="hinput"></div>
</div>
<div class="row">
<div class="htitle">Customer PO Number</div>
<div class="hinput"></div>
</div>
</div>
<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'CusDetails')" id="defaultOpen">Customer Details</button>
  <button class="tablinks" onclick="openTab(event, 'ShipDetails')">Shipment Details</button>
  <button class="tablinks" onclick="openTab(event, 'OthDetails')">Other Details</button>
  <button class="tablinks" onclick="openTab(event, 'LineDetails')">Line Details</button>
</div>

<div id="CusDetails" class="tabcontent">
  <div class="row">
  	<div class="title">Customer</div>
    <div class="input">
    <select>
      <option>Cus 1</option>
      <option>Cus 2</option>
    </select>
    </div>
  </div>
    <div class="row">
  	<div class="title">Name</div>
    <div class="input"><input name="name" type="text" /></div>
  </div>
    <div class="row">
  	<div class="title">Attention</div>
    <div class="input"><textarea name="att" cols="" rows=""></textarea></div>
  </div>
    <div class="row">
  	<div class="title">Address Line 1</div>
    <div class="input"><input name="name" type="text" /></div>
  </div>
    <div class="row">
  	<div class="title">Address Line 2</div>
    <div class="input"><input name="name" type="text" /></div>
  </div>
    <div class="row">
  	<div class="title">City/Suurb</div>
    <div class="input"><input name="name" type="text" class="inputmid" /></div>
  </div>
    <div class="row">
  	<div class="title">State</div>
    <div class="input"><input name="name" type="text" class="inputsml" /></div>
  </div>
    <div class="row">
  	<div class="title">Post Code</div>
    <div class="input"><input name="name" type="text" class="inputsml" /></div>
  </div>
    <div class="row">
  	<div class="title">Country</div>
    <div class="input"><input name="name" type="text" class="inputmid" /></div>
  </div>
</div>

<div id="ShipDetails" class="tabcontent">
	<div class="row">
  	<div class="title">Shipment Code</div>
    <div class="input">	<select>
      					<option>Code 1</option>
      					<option>Code 2</option>
    					</select>
    </div>
  </div>
    <div class="row">
  	<div class="title">Attention</div>
    <div class="input"><textarea name="att" cols="" rows=""></textarea></div>
  </div>
    <div class="row">
  	<div class="title">Address Line 1</div>
    <div class="input"><input name="name" type="text" /></div>
  </div>
    <div class="row">
  	<div class="title">Address Line 2</div>
    <div class="input"><input name="name" type="text" /></div>
  </div>
        <div class="row">
  	<div class="title">City/Suurb</div>
    <div class="input"><input name="name" type="text" class="inputmid" /></div>
  </div>
    <div class="row">
  	<div class="title">State</div>
    <div class="input"><input name="name" type="text" class="inputsml" /></div>
  </div>
    <div class="row">
  	<div class="title">Post Code</div>
    <div class="input"><input name="name" type="text" class="inputsml" /></div>
  </div>
    <div class="row">
  	<div class="title">Country</div>
    <div class="input"><input name="name" type="text" class="inputmid" /></div>
  </div>
</div>

<div id="OthDetails" class="tabcontent">
	<div class="row">
  	<div class="title">Default Whse</div>
    <div class="input">
    <select>
    <option>Option 1</option>
    <option>Option 2</option>
    </select>
    </div>
  </div>
    <div class="row">
  	<div class="title">Term Code</div>
    <div class="input">
        <select>
    <option>Option 1</option>
    <option>Option 2</option>
    </select>
<span class="dis">Description</span>
    </div>
  </div>
    <div class="row">
  	<div class="title">Order Currency</div>
    <div class="input">
        <select>
    <option>Option 1</option>
    <option>Option 2</option>
    </select>
<span class="dis">Description</span>
    </div>
  </div>
    <div class="row">
  	<div class="title">Term Code</div>
    <div class="input">
        <select>
    <option>Option 1</option>
    <option>Option 2</option>
    </select>
<span class="dis">Description</span>
    </div>
  </div>
    <div class="row">
  	<div class="title">Payment Method</div>
    <div class="input">
        <select>
    <option>Option 1</option>
    <option>Option 2</option>
    </select>
<span class="dis">Description</span>
    </div>
  </div>
    <div class="row">
  	<div class="title">Status</div>
    <div class="input">
<input name="name" type="text" class="inputsml" />
    </div>
  </div>
    <div class="row">
  	<div class="title">Freight</div>
    <div class="input">
<input name="name" type="text" class="inputsml"/>
    </div>
  </div>
    <div class="row">
  	<div class="title">Total Price</div>
    <div class="input">
<input name="name" type="text"class="inputsml" />
    </div>
  </div>
   
</div>

<div id="LineDetails" class="tabcontent">
	<div class="gdheader">
    <div class="partnumberh">Part Number</div>
    <div class="descriptionh">Description</div>
    <div class="whscodeh">Whs Code</div>
    <div class="uomavlqtyh">UOM Available Qty</div>
    <div class="qtyh">Qty</div>
    <div class="costh">Cost</div>
    <div class="totalh">Total</div>
    <div class="freighth">Freight</div>
    <div class="cfcosth">C&F Cost</div>
    <div class="marginh">Margin</div>
    <div class="salesh">Sales</div>
    <div class="sellingh">Selling</div>
    <div class="linenotesh">Line Notes</div>
    </div>
    
    <div class="gdbody">
    <div class="partnumber">&nbsp;</div>
    <div class="description">&nbsp;</div>
    <div class="whscode">&nbsp;</div>
    <div class="uomavlqty">&nbsp;</div>
    <div class="qty">&nbsp;</div>
    <div class="cost">&nbsp;</div>
    <div class="total">&nbsp;</div>
    <div class="freight">&nbsp;</div>
    <div class="cfcost">&nbsp;</div>
    <div class="margin">&nbsp;</div>
    <div class="sales">&nbsp;</div>
    <div class="selling">&nbsp;</div>
    <div class="linenotes">&nbsp;</div>
    </div></div>
</div>
</div>
</div>



<script language="javascript" type="text/javascript" src="js/tabcsript.js"></script>
</body>
</html>
