<?php
require('classes/common.php');
?>
<h1>ACE Enterprise Solutions </h1>
<div class="dropdown">
  <button class="dropbtn">Purchasing</button>
  <div class="dropdown-content">
    <a href="vender.php">Supplier Maintenance</a>
	<a href="purchase-order.php">Purchase Order Entry</a>
	<a href="purchase-order.php?manipulate=true"> Amend Purchase Order</a>
    <a href=" po-receitps.php">Purchase Order Receipt</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Inventory</button>
  <div class="dropdown-content">
     <a href="items_New.php">Part Maintenance</a>
    <a>Warehouse Setup</a>
    <a>Location Setup</a>
	<a>Inventory Inquiry</a>
	<a>Inventory Transactions</a>
  </div>
 </div>
 <div class="dropdown">
  <div class="dropdown">
  <button class="dropbtn">Customer Order</button>
  <div class="dropdown-content">
    <a href="SalesOrder.php">Customer Order Entry</a>
    <a>Order Delivery</a>
	<a>Invoicing</a>
  </div>
</div>
</div>