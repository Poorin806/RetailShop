<?php
include '../connect.php';
// Retrieve the cust_id from the AJAX request
if (isset($_POST["cust_id"])) {
    $cust_id = $_POST["cust_id"];

    $sql = "SELECT CONCAT(cust_name, ' ', cust_lastname) as full_name FROM customer WHERE cust_id = '$cust_id'";
    $result=$con->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fullName = $row["full_name"];
        echo $fullName;
    } else {
        echo "ไม่พบลูกค้า";
    }
}
?>