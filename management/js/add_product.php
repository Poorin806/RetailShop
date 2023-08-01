<?php
    include '../connect.php';

    if (isset($_POST["pro_id"], $_POST["pro_amount"], $_POST["sale_id"], $_POST["pro_saleprice"], $_POST["discount"])) {
        $sale_id = $_POST['sale_id'];
        $pro_id = $_POST['pro_id'];
        $pro_amount = $_POST['pro_amount'];
        $pro_saleprice = $_POST['pro_saleprice'];
        $discount = $_POST['discount'];

        $sql_check = "SELECT * FROM sale_detail WHERE sale_id = '$sale_id' AND pro_id = '$pro_id'";
        $result_check = $con->query($sql_check);
        if($result_check){
            $row = mysqli_num_rows($result_check);
            if($row!=0){
                //update exist product amount
                $sql ="UPDATE sale_detail set Amount = Amount + '$pro_amount', discount = discount + '$discount' WHERE sale_id = '$sale_id' AND pro_id = '$pro_id'";
                $result = $con->query($sql);

                $sql_update = "UPDATE product set pro_amount = pro_amount - '$pro_amount' WHERE pro_id = '$pro_id'";
                $result_update=$con->query($sql_update);

                // echo $sql . $sql_update;

                if($result && $result_update){
                    echo "true";
                }else{
                    echo "false";
                }
            }else{
                //insert new product
                $sql = "INSERT INTO sale_detail (sale_id, pro_id, amount, sale_price, discount)
                values('$sale_id','$pro_id','$pro_amount', '$pro_saleprice', '$discount')
                ";
                $result = $con->query($sql);

                $sql_update = "UPDATE product set pro_amount = pro_amount - '$pro_amount' WHERE pro_id = '$pro_id'";
                $result_update=$con->query($sql_update);

                // echo $sql . $sql_update;

                if($result && $result_update){
                    echo "true";
                }else{
                    echo "false";
                }
            }
        }

        
    }
?>