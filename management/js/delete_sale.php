<?php
include '../connect.php';
if (isset($_POST['sale_id'])) {
    $sale_id = $_POST['sale_id'];

    //To check finishing of Sale
    $sql_check = "SELECT net_price FROM sale WHERE sale_id = '$sale_id'";
    $result_check = $con->query($sql_check);
    
    if ($result_check) {
        $row = mysqli_fetch_array($result_check);
        //If sale (net_price) == 0.00 that means Sale does not finish yet
        //If not equal 0.00 that means Sale is finished
        if ($row['net_price'] == 0.00) {
            $sql_1 = "DELETE FROM sale_detail WHERE sale_id = '$sale_id'";
            $result1 = $con->query($sql_1);

            $sql_2 = "DELETE FROM sale WHERE sale_id = '$sale_id'";
            $result2 = $con->query($sql_2);

            if ($result1 && $result2) {
                echo 'delete_success';
            } else {
                echo 'delete_error';
            }
        }else{
            echo "sale_done";
        }
    }
}
