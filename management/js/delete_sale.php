<?php
include '../connect.php';
if(isset($_POST['sale_id'])){
    $sale_id = $_POST['sale_id'];

    $sql_1 = "DELETE FROM sale_detail WHERE sale_id = '$sale_id'";
    $result1 = $con->query($sql_1);

    $sql_2 = "DELETE FROM sale WHERE sale_id = '$sale_id'";
    $result2 = $con->query($sql_2);

    if ($result1 && $result2) {
        echo true;
    } else {
        echo false;
    }
}
?>