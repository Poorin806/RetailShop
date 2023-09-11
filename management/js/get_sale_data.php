<?php
include '../connect.php';

if (isset($_POST['function']) && $_POST['function'] == "SearchSale_Info") {
    $Sale_id = $_POST['Sale_id'];
    $sql = "SELECT sale.Sale_id, sale.Cust_id, customer.Cust_name, sale.Sale_date 
            FROM sale
            INNER JOIN customer ON customer.Cust_id = sale.Cust_id 
            WHERE sale_id = '$Sale_id';";
    $result = $con->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // echo $row['Cust_id'];
        $saleData = array(
            "sale_id" => $row["Sale_id"],
            "cust_id" => $row["Cust_id"],
            "cust_name" => $row["Cust_name"],
            "sale_date" => formatDateTimeThai($row["Sale_date"])
        );
        // Convert the array to JSON format
        $jsonResponse = json_encode($saleData);

        // Return the JSON response
        echo $jsonResponse;
    } else {
        echo false;
    }
}


// The new one (Using Ajax - JQuery)
if (isset($_POST['function']) && $_POST['function'] == "SearchSale") {
    $Sale_id = $_POST['Sale_id'];

    $sql = "SELECT 
                product_return.*, product.Pro_name, product.Pro_salePrice,
                (product_return.Amount *  product.Pro_salePrice) AS total
            FROM product_return
            JOIN product ON product_return.Pro_id = product.Pro_id
            WHERE
                product_return.Sale_id = '$Sale_id'
    ";
    
    $data = [];
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    } else {
        $result = false;
        echo json_encode($result);
    }
}

if (isset($_POST['function']) && $_POST['function'] == "getSaleDetail") {
    $Sale_id = $_POST['Sale_id'];

    $sql = "SELECT sale_detail.*, product.Pro_name, 
                ((sale_detail.Sale_price * sale_detail.Amount) - sale_detail.Discount) AS Total
            FROM 
            sale_detail 
            JOIN
            product ON sale_detail.Pro_id = product.Pro_id
            WHERE sale_id = '$Sale_id'
    ";

    $data = [];
    $result = $con->query($sql);

    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    }
    else {
        $result = false;
        echo json_encode($data);
    }
}

if (isset($_POST['function']) && $_POST['function'] == "confirmReturn") {
    $Sale_id = $_POST['Sale_id'];
    $Pro_id_arr = $_POST['Pro_id_arr'];
    $Return_arr = $_POST['Return_arr'];


    if ($_POST['Comment'] == "" || $_POST['Comment'] == null) {
        $Comment = "ไม่มี";
    }
    else {
        $Comment = $_POST['Comment'];
    }

    $New_ReturnData = [];

    $total_return_price = 0;

    // Get Return Data
    for ($i = 0; $i < count($Pro_id_arr); $i++) {
        if ($Return_arr[$i] > 0) {
            $returnItem = [
                'Pro_id' => $Pro_id_arr[$i],
                'Return_Amount' => $Return_arr[$i],
                'Comment' => $Comment,
            ];

            // Get Product Sale Price
            $TEMP_Pro_id = $Pro_id_arr[$i];
            $sql = "SELECT * FROM product WHERE Pro_id = '$TEMP_Pro_id'";
            $query = $con->query($sql);
            $result = $query->fetch_assoc();
            $TEMP_Pro_salePrice = $result['Pro_salePrice'];
            $TEMP_ReturnAmount = $Return_arr[$i];
            $TEMP_ReturnDate = date("Y-m-d H:i:s");

            $returnItem['Pro_salePrice'] = $TEMP_Pro_salePrice;
            $New_ReturnData[] = $returnItem;

            // Increase Total Price to Update Sales (Total Price)
            $total_return_price += $TEMP_Pro_salePrice * $TEMP_ReturnAmount;

            // Update Return Data
            $sql = "INSERT INTO product_return VALUES 
                    (null, '$Sale_id', '$TEMP_Pro_id', $TEMP_ReturnAmount, '$TEMP_ReturnDate', '$Comment', 1)
            ";
            $query = $con->query($sql);
            

            // Update Product Amount in Sale Details
            // Remove amount in Sale Details
            $sql = "UPDATE sale_detail SET Amount = (Amount - $TEMP_ReturnAmount) WHERE Sale_id = '$Sale_id' AND Pro_id = '$TEMP_Pro_id'";
            $query = $con->query($sql);
        }
    }

    // Update Sale Total Price
    $sql = "UPDATE sale SET Net_price = (Net_price - $total_return_price) WHERE Sale_id = '$Sale_id'";
    $query = $con->query($sql);

    echo json_encode(true);

}
