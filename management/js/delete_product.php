<?php
    include '../connect.php';
    if(isset($_POST['sale_id'], $_POST['pro_id'])){
        $sale_id = $_POST['sale_id'];
        $pro_id = $_POST['pro_id'];
        $sql = "DELETE FROM sale_detail WHERE sale_id = '$sale_id' AND pro_id = '$pro_id'";
        $result = $con->query($sql);
        if($result){
            echo 'true';
        }else{
            echo 'false';
        }
    }
?>