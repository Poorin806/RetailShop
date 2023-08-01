<?php
include '../connect.php';


if (isset($_POST["sale_id"], $_POST["cust_id"], $_POST["sale_date"])) {
    $cust_id = $_POST['cust_id'];
    $sale_id = $_POST['sale_id'];
    $sale_date = $_POST['sale_date'];

    $sql = "INSERT INTO sale (sale_id, cust_id, sale_date, net_price, net_discount, sale_status)
            values('$sale_id','$cust_id','$sale_date',0.0,0.0,0)
            ";
    $result = $con->query($sql);


    if($result){
        echo "true";
    }else{
        echo "false";
    }
    // if ($result) {
    //     $status = array(
    //         "message" => "สร้างการขายสำเร็จ",
    //         "button" => "btn-primary",
    //         "btn_status" => "enabled"
    //     );
    // } else {
    //     $status = array(
    //         "message" => "สร้างการขายไม่สำเร็จ",
    //         "button" => "btn-secondary",
    //         "btn_status" => "disabled"
    //     );
    // }
    
    // Convert the array to JSON format
    // $jsonResponse = json_encode($status);
    
    // Output the JSON response (for debugging purposes)
    // echo $jsonResponse;
}
