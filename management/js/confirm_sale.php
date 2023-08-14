<?php
include '../connect.php';

// Retrieve the pro_id from the AJAX request
if (isset($_POST["sale_id"], $_POST['net_price'], $_POST['net_discount'], $_POST['sale_status'])) {
    $sale_id = $_POST['sale_id'];
    $net_price = $_POST['net_price'];
    $net_discount = $_POST['net_discount'];
    $sale_status = 0;

    $sql = "UPDATE sale
            SET
            net_price = '$net_price',
            net_discount = '$net_discount',
            sale_status = '$sale_status'
            WHERE sale_id = '$sale_id';
            ";
    $result = $con->query($sql);
    if ($result) {
        echo true;
    } else {
        echo false;
    }
}
