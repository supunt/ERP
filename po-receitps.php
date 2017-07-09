<?php require('header.php'); ?>
<?php require('classes/db.php'); ?>
<body>
 <div class="container">
     <?php require('topNav.php'); ?>
        <div class="poreceitpsForm">
            <h2>Purchase order receipt</h2>
            <form>
                <div class="row">
                    <div class="title">Vendor </div>
                    <div class="input">
                        <select name="vendor-list" id="vendorlist" onchange="">
                            <option value=""> Select Vendor</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="title">Purchase Order Number</div>
                    <div class="input xwide">
                       <input id="po-number" name="po-number" value="" placeholder="Enter PO Number">
                        <div class="button-right find-po">Find</div>
                        <span class="msg-po-number"></span>
                    </div>

                </div>
                <div class="row"></div>
                <div class="row">
                    <div class="title">Purchase Order Date</div>
                    <div class="input xwide">
                        <input id="po-date" name="po-date" value="" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="title">Warehouse Code</div>
                    <div class="input xwide">
                        <input id="po-whcode" name="po-whcode" value="" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="title"></div>
                    <div class="input xwide">
                        <h3>Purchase Order Details</h3>
                    </div>
                </div>
                <div class="row"></div>
                <div class="row">
                    <div class="title"></div>
                    <table id="po-details">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Part Number</td>
                                <td>Location</td>
                                <td>Requested Qty</td>
                                <td>Received Qty</td>
                                <td>Received Date</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="edit-row-container">
                <div class="row edit-row">
                    <div class="input xwide pull-left">
                        <div>Part Number</div>
                        <input type="text" id="po-partnumber" name="po-whcode" value="" readonly>
                    </div>
                    <div class="input xwide pull-left">
                        <div>Location</div>
                        <select name="location-list" id="locationlist">
                            <option value=""> Select Location</option>
                        </select>
                    </div>
                    <div class="input xwide pull-left">
                        <div>Requested Qty</div>
                        <input type="text" id="po-req-qty" name="po-req-qty" value="" readonly>
                    </div>
                    <div class="input xwide pull-left">
                        <div>Received Qty</div>
                        <input type="text" id="po-res-qty" name="po-res-qty" value="">
                    </div>
                    <div class="input xwide pull-left">
                        <div>Received Date</div>
                        <input type="text" id="po-res-date" name="po-res-date" value="" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="input xwide pull-left">
                        <div>&nbsp;</div>
                        <div class="button-right po-done-edit">Done</div>
                    </div>
                    <input type="hidden" id="hd-td-podid" name="po-res-date" value="">
                </div>
            </div>
            <div class="inputs">
                <div class="button-right form-buttons po-save">Save</div>
                <div class="button-right form-buttons po-cancel">Cancel</div>
            </div>
            <div class="inputs">
                <div class="po-message"></div>
            </div>
        </div>
    </div>
</body>

<script src="js/po-receipt.js"></script>
<script>

</script>