<?php

    include '../connect.php';

    // รับค่า object ที่เป็น array จาก Ajax
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data, $_GET['Sale_id'])) {

        $Sale_id = $_GET['Sale_id'];

        // var_dump($data[0]);
        // echo "<br><br><br>". count($data);
        // echo $_GET['Sale_id'];

        for ($i = 0; $i < count($data) - 1; $i++) {

            $Pro_id = $data[$i]['pro_id'];
            $Amount = $data[$i]['amount'];
            
            $ReturnAmount = $data[$i]['return_amount'];
            $Price = $data[$i]['sale_price'];
            $PriceUpdate = $ReturnAmount * $Price;

            $Discount = $data[$i]['discount'];  //Product discount
            if ($ReturnAmount != $Amount) {
                $Discount = 0;
            }

            $Date = date("Y-m-d H:i:s");
            $Comment = $data[count($data) - 1]['comment'];
            if ($Comment == "") {
                $Comment = "ไม่มี";
            }
            

            // echo $Pro_id . ", " . $Amount . ", " . $Date . ", " . $Comment . "<br>";

            if ($Amount != 0) {
                $sql = "INSERT INTO product_return 
                        VALUES(null,
                        '$Sale_id',
                        '$Pro_id',
                        '$ReturnAmount',
                        '$Date',
                        '$Comment',
                        1);
                        ";
                echo $sql . "<br>";
                $con->query($sql);

                //Update product (Return product)
                $sql = "UPDATE product SET Pro_amount = Pro_amount + $ReturnAmount WHERE (Pro_id = '$Pro_id')";
                $con->query($sql);
                echo $sql . "<br>";

                //Update sale_detail
                if ($ReturnAmount == $Amount) {
                    $sql = "DELETE FROM sale_detail WHERE (Pro_id = '$Pro_id') AND (Sale_id = '$Sale_id')";
                }
                else {
                    $sql = "UPDATE sale_detail SET Amount = Amount - $ReturnAmount WHERE (Pro_id = '$Pro_id') AND (Sale_id = '$Sale_id')";
                }
                echo $sql . "<br>";
                $con->query($sql);

                //Update sale (Update total price)
                if ($ReturnAmount == $Amount) {
                    $sql = "UPDATE sale SET Net_price = Net_price - $PriceUpdate, Net_discount = Net_discount - $Discount WHERE (Sale_id = '$Sale_id')";
                }
                else {
                    $sql = "UPDATE sale SET Net_price = Net_price - $PriceUpdate WHERE (Sale_id = '$Sale_id')";
                }
                // echo $sql . "<br>";
                $con->query($sql);
            }
        }
    }
?>