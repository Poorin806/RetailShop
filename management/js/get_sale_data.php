<?php
include '../connect.php';

if (isset($_POST['sale_id'])) {
    $sale_id = $_POST['sale_id'];
    $sql = "SELECT sale.Sale_id, sale.Cust_id, customer.Cust_name, sale.Sale_date 
            FROM sale
            INNER JOIN customer ON customer.Cust_id = sale.Cust_id 
            WHERE sale_id = '$sale_id';";
    $result = $con->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // echo $row['Cust_id'];
        $saleData = array(
            "sale_id" => $row["Sale_id"],
            "cust_id" => $row["Cust_id"],
            "cust_name" => $row["Cust_name"],
            "sale_date" => $row["Sale_date"]
        );
        // Convert the array to JSON format
        $jsonResponse = json_encode($saleData);

        // Return the JSON response
        echo $jsonResponse;
    } else {
        echo false;
    }
}
