<?php require('header.php'); ?>
<?php require('classes/db.php'); ?>
<?php
    $method = 'add';
    $selected = '';
    $id = '';
    $alldata = "SELECT * FROM vendermaster order by Id desc";
    $result = $conn->query($alldata);

    if (!isset($_GET['action'])) {
        $_GET['action'] = "";
    }

    if (!isset($_GET['mode'])) {
        $_GET['mode'] = "";
    }

    if ($_GET['action'] == 'update') {
        $method = 'update';
        $id = $_GET['id'];
        $rowData = "SELECT * FROM vendermaster where Id=" . $id;
        $rowResult = $conn->query($rowData);
        if ($rowResult->num_rows == 0) {
            echo "There is no data for this ID. Please contact administrator.";
            die();
        }
        $updaterow = mysqli_fetch_assoc($rowResult);
    }

    if ($_GET['action'] == 'delete') {
        $method = 'delete';
        $id = $_GET['id'];
        $rowData = "SELECT * FROM vendermaster where Id=" . $id;
        $rowResult = $conn->query($rowData);
        if ($rowResult->num_rows == 0) {
            echo "There is no data for this ID. Please contact administrator.";
            die();
        }
        $updaterow = mysqli_fetch_assoc($rowResult);

    }
?>
<body>
    <div class="container">
        <?php require('topNav.php'); ?>
        <div class="vendorMasForm">
            <h2>Vendor Master</h2>
            <form id="frm_vendor" action="classes/vendorMaster.php" method="POST">
                <div class="row">
                    <div class="title">Mode</div>
                    <div class="input">
                        <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
                            <option value="">Select Mode</option>
                            <option value="vender.php?mode=add" <?php if ($_GET['mode'] == 'add') { ?> selected <?php } ?>>
                                Add
                            </option>
                            <option
                                value="vender.php?mode=view" <?php if ($_GET['mode'] == 'view') { ?> selected <?php } ?>>
                                View
                            </option>
                            <option
                                value="vender.php?mode=update" <?php if ($_GET['mode'] == 'update') { ?> selected <?php } ?>>
                                Update
                            </option>
                            <option
                                value="vender.php?mode=delete" <?php if ($_GET['mode'] == 'delete') { ?> selected <?php } ?>>
                                Delete
                            </option>
                        </select>
                    </div>

                </div>


                <div class="row">
                    <div class="title">Vendor Name</div>
                    <div class="input">
                        <?php
                        if ($_GET['mode'] == 'add') {
                            $method = 'add';
                            ?>
                            <input class="txt_name" name="vname"
                                   value="<?php echo($_GET['action'] == 'update' ? $updaterow['vname'] : ''); ?>" maxlength="150"/>
                            <?php
                        }

                        if ($_GET['mode'] == 'update') {
                            $method = 'update';
                            ?>
                            <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
                                <option <?php echo $selected; ?>
                                    value=""><?php echo(isset($_GET['name']) ? $_GET['name'] : '') ?></opiton>

                                    <?php if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                    $selected = '';
                                    if (isset($updaterow['VendorID']) && $_GET['action'] == 'update' && $row['id'] == $updaterow['vendorID']) {
                                        $selected = 'selected';
                                    }
                                    ?>
                                <option
                                    value="vender.php?action=update&mode=update&id=<?php echo $row['id']; ?>&name=<?php echo $row['vname']; ?> "><?php echo $row['vname']; ?></opiton>

                                    <?php }
                                    } ?>
                            </select>

                            <input type="hidden" name="vname" value="<?php echo $_GET['name'] ?>"/>
                            <?php
                        }
                        if ($_GET['mode'] == '') {
                            ?>
                            <input class="txt_name" name="vname"><?php echo($_GET['action'] == 'update' ? $updaterow['vname'] : ''); ?></input>
                            <?php
                        }

                        if ($_GET['mode'] == 'delete') {
                            $method = 'delete';
                            ?>
                            <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
                                <option <?php echo $selected; ?> value=""><?php echo(isset($_GET['name']) ? $_GET['name'] : '') ?></opiton>
                                    <?php if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                    $selected = '';
                                    if (isset($updaterow['vendorID']) && $_GET['action'] == 'delete' && $row['id'] == $updaterow['vendorID']) {
                                        $selected = 'selected';
                                    }
                                    ?>
                                <option
                                    value="vender.php?action=delete&mode=delete&id=<?php echo $row['id']; ?>&name=<?php echo $row['vname']; ?>"><?php echo $row['vname']; ?></opiton>

                                    <?php }
                                    } ?>
                            </select>
                            <input type="hidden" name="vname" value="<?php echo $_GET['name'] ?>"/>
                            <?php
                        }


                        if ($_GET['mode'] == 'view') {
                            $method = 'delete';
                            ?>
                            <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
                                <option <?php echo $selected; ?>
                                    value=""><?php echo(isset($_GET['name']) ? $_GET['name'] : '') ?></opiton>
                                    <?php if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                    $selected = '';
                                    if ((isset($updaterow['vendorID'])) && $_GET['action'] == 'delete' && $row['id'] == $updaterow['vendorID']) {

                                        $selected = 'selected';
                                    }
                                    ?>
                                <option
                                    value="vender.php?action=delete&mode=view&id=<?php echo $row['id']; ?>&name=<?php echo $row['vname']; ?>"><?php echo $row['vname']; ?></opiton>

                                    <?php }
                                    } ?>
                            </select>
                            <input type="hidden" name="vname"
                                   value="<?php echo(isset($_GET['name']) ? $_GET['name'] : '') ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php  if ( isset( $_GET['msg'] ) ) { ?>
                        <h3><?php echo $_GET['msg'] ?></h3>
                    <?php } ?>
                </div>

                <div class="row">
                    <div class="title">Description :</div>
                    <div class="input"><textarea
                            name="description"  maxlength="250" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> ><?php echo($_GET['action'] == 'update' ? $updaterow['description'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['description'] : ''); ?></textarea>
                    </div>
                    <div class="title">Address 1 :</div>
                    <div class="input"><textarea
                            name="addess1" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> ><?php echo($_GET['action'] == 'update' ? $updaterow['address1'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['address1'] : ''); ?></textarea>
                    </div>

                    <div class="title">Address 2 :</div>
                    <div class="input"><textarea
                            name="addess2" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> ><?php echo($_GET['action'] == 'update' ? $updaterow['address2'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['address2'] : ''); ?></textarea>
                    </div>
                    <div class="title">Suburb :</div>

                    <div class="input"><input name="suburb" type="text"
                                              value="<?php echo($_GET['action'] == 'update' ? $updaterow['suburb'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['suburb'] : ''); ?>" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
                    </div>
                    <div class="title">State :</div>
                    <div class="input"><input name="state" type="text"
                                              value="<?php echo($_GET['action'] == 'update' ? $updaterow['state'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['state'] : ''); ?>" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
                    </div>

                    <div class="title">Post code :</div>
                    <div class="input"><input name="postcode" type="text"
                                              value="<?php echo($_GET['action'] == 'update' ? $updaterow['postcode'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['postcode'] : ''); ?>" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
                    </div>

                    <div class="title">Country :</div>
                    <div class="input"><input name="country" type="text"
                                              value="<?php echo($_GET['action'] == 'update' ? $updaterow['country'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['country'] : ''); ?>" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
                    </div>

                    <div class="title">Terms Code:</div>
                    <div class="input">
                        <?php if ($_GET['action'] == 'delete') { ?>
                            <input name="termsCode" type="text"
                                   value="<?php echo($_GET['action'] == 'delete' ? $updaterow['termscode'] : ''); ?>" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> />
                        <?php } else {
                            ?>

                            <select name="termsCode">
                                <?php foreach ($jsonData['termsCode'] as $key => $val) {
                                $selected = '';
                                if ($_GET['action'] == 'update' && $key == $updaterow['termscode']) {
                                    $selected = 'selected';
                                }
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $val; ?></opiton>
                                    <?php } ?>
                            </select>
                        <?php } ?>
                    </div>

                    <div class="title">Extra field 1 :</div>
                    <div class="input"><textarea
                            name="extraf1"  maxlength="100" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> ><?php echo($_GET['action'] == 'update' ? $updaterow['extrafield1'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['extrafield1'] : ''); ?></textarea>
                    </div>
                    <div class="title">Extra field 2 :</div>
                    <div class="input"><textarea
                            name="extraf2" maxlength="100" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> ><?php echo($_GET['action'] == 'update' ? $updaterow['extrafield2'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['extrafield2'] : ''); ?></textarea>
                    </div>
                    <div class="title">Extra field 2 :</div>
                    <div class="input"><textarea
                            name="extraf3" maxlength="100" <?php echo($_GET['action'] == 'delete' ? "readonly" : ''); ?> ><?php echo($_GET['action'] == 'update' ? $updaterow['extrafield3'] : ''); ?><?php echo($_GET['action'] == 'delete' ? $updaterow['extrafield3'] : ''); ?></textarea>
                    </div>

                </div>


                <div class="row">

                    <div class="title">&nbsp;</div>
                    <div class="input">
                        <?php if ($_GET['mode'] == 'delete') { ?>  <a
                            href="classes/vendorMaster.php?action=delete&id=<?php echo $_GET['id']; ?>"
                            onClick="return confirm('Are you sure?')" class="delete">Delete </a> <?php } ?>
                        <?php if ($_GET['action'] == 'update') { ?>  <input type="submit" value="Update"> <?php } ?>
                        <?php if ($_GET['mode'] == 'add') { ?>  <input class="button" type="submit" value="Add New"> <?php } ?>
                        <?php if ($_GET['mode'] == 'view') { ?><?php } ?>
                        <a class="button cancel">Cancel </a>
                    </div>


                </div>

                <input type="hidden" name="formMethod" value="<?php echo $method; ?>"/>
                <input type="hidden" name="itemID" value="<?php echo $id; ?>"/>
            </form>
        </div>
    </div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/custom.js"></script>
<script>
    $.noConflict(); //Taking over the $

    $(function () {
        $( "#frm_vendor").submit(function (event) {

            if ( $('.txt_name').val() == "") {
                alert("Vendor name can't be empty.");
                event.preventDefault();
            }

        });

        $('.cancel').click(function(){

            window.location = window.location.href.split("?")[0];

        });

    });
</script>

</html>