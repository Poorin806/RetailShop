<?php
include '../connect.php';

// Retrieve the pro_id from the AJAX request
if (isset($_POST["pro_id"])) {
    $pro_id = $_POST["pro_id"];

    $sql = "SELECT pro_name, pro_saleprice, pro_amount FROM product WHERE pro_id = '$pro_id'";
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Create an associative array with the product information
        $productInfo = array(
            "pro_name" => $row["pro_name"],
            "pro_saleprice" => $row["pro_saleprice"],
            "pro_amount" => $row["pro_amount"]
        );

        // Convert the array to JSON format
        $jsonResponse = json_encode($productInfo);

        // Return the JSON response
        echo $jsonResponse;
    } else {
        echo "ไม่พบสินค้า";
    }
}
