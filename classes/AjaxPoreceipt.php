<?php
require('db.php');

if ( isset ( $_POST ) ) {

    switch ( $_POST['action'] ) {
        case ('getVendor'):
            getVendor( $conn );
            break;

        case ('findPo'):
            if ( isset($_POST['po_number']) && isset($_POST['vendor']) ) {

                findPo($conn, $_POST['vendor'], $_POST['po_number']);

            }

            break;
        case ('getPoDetails'):
            if ( isset($_POST['po_number']) ) {

                getPoDetails($conn, $_POST['po_number']);

            }
            break;

        case ('getLocations'):
            getLocations( $conn );
            break;

        case ('save'):
            if ( isset($_POST['data']) ) {

                save($conn, $_POST['data']);

            }

            break;
    }

}

function findPo( $conn, $vendor = null, $po_number = null ) {

    if ( !is_null($po_number) && !is_null($vendor) ) {

        $sql = "SELECT * FROM purchaseorder WHERE vendorno='".$vendor."' AND pid='" . $po_number . "' AND status <> 'R'";
        $rowResult = $conn->query($sql);

        if ($rowResult->num_rows > 0) {
            $row = mysqli_fetch_assoc($rowResult);

           echo json_encode( $row );

        } else {

            echo "not found";

        }

    } else {

        echo "error";

    }

}

function getPoDetails($conn,  $po_number = null ) {

    if ( !is_null($po_number)  ) {

        $sql = "SELECT * FROM purchaseorderetails WHERE pid='". $po_number ."'";

        $po_details = mysqli_query($conn, $sql);

        if ($po_details->num_rows > 0) {

            while ($po_details_row = $po_details->fetch_assoc()) {
                $arr_po_details[] = $po_details_row;
            }


            echo json_encode( $arr_po_details );

        } else {
            echo "error";
        }
    }
}


function getVendor( $conn ) {

    $sql = "SELECT id,vname FROM vendermaster";

    $vendors = mysqli_query($conn, $sql);

    if ($vendors->num_rows > 0) {

        while ($row = $vendors->fetch_assoc()) {
            $name_list[] = $row;
        }


        echo json_encode( $name_list );

    } else {
        echo "error";
    }

}

function getLocations( $conn ) {

    $sql = "SELECT code,name FROM location_master";

    $locations = mysqli_query($conn, $sql);

    if ($locations->num_rows > 0) {

        while ($row = $locations->fetch_assoc()) {
            $location_list[] = $row;
        }

        echo json_encode( $location_list );

    } else {
        echo "error";
    }

}


function save( $conn, $data ) {
    $data = json_decode($data);
    $error = false;
    $order_complete = true;

    foreach ($data as $row) {

        if ( isset( $row->pid ) && $row->pid != '' ) {
            $pid = $row->pid;
        }

        updateHistory( $conn, $row );

        $sql = "UPDATE purchaseorderetails SET ".
            "location ='". $row->location ."',".
            "receptquantity ='". $row->receptquantity ."',".
            "receiveddate ='". $row->receiveddate ."',".
            "linestatus ='". $row->linestatus ."' ".
            "WHERE podid =".$row->podid;

        if ($conn->query($sql) == true) {

        } else {
            $error = true;
        }

        if ( $row->linestatus == 'Y' ) {

            if ( $order_complete ) {

                $order_complete = true;

            }

        } else {

            $order_complete = false;

        }
    }

    if ($error) {
        echo "error";
    } else {

        if ( $order_complete ) {

            updateHeader($conn, $pid);

        }

        echo "done";
    }
}

/**
 * @desc update purchaseorder table status to R
 * @param $conn
 * @param $pid
 */
function updateheader( $conn, $pid ) {
    $sql = "UPDATE purchaseorder SET status = 'R' WHERE pid =".$pid;
    $conn->query($sql);
}

/**
 * @desc Write to history file
 * @param $conn
 * @param $row
 */
function  updateHistory( $conn, $row ) {

    $sql = "INSERT INTO `transaction_history` (`part_number`, `warehouse_code`, `location_code`, `quantity`, `cost`, `price`, `ref_number`, `line_number`, `careted_date`)
SELECT pod.`partnumber`, po.`warehousecode`, pod.`location`, pod.quantity, items.cost, items.listPrice, po.pid, pod.podid, CURRENT_TIMESTAMP()
FROM purchaseorderetails as pod
inner join purchaseorder as po on pod.pid = po.pid
inner join items on pod.`partnumber` = items.id
WHERE pod.podid =" .$row->podid;

    mysqli_query($conn, $sql);


}
