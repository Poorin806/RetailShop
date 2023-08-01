<?php
include '../connect.php';

if (isset($_POST['sale_id'])) {
    $sale_id = $_POST['sale_id']; // Get the 'sale_id' from the POST data

    // Prepare and execute the SQL query
    $sql = "SELECT sale_detail.Sale_id, sale_detail.pro_id, product.pro_name, sale_detail.Amount, sale_detail.Sale_price, sale_detail.Discount FROM sale_detail INNER JOIN product ON sale_detail.Pro_id = product.Pro_id WHERE sale_id = '$sale_id'";
    $result = $con->query($sql);

    if (!$result) {
        // If there's an error in the SQL query, send the error message in the JSON response
        $error_message = mysqli_error($con);
        $response = array("error" => $error_message);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Fetch data and return the JSON response
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>
