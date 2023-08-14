<?php include './connect.php' ?>
<?php
$sale_id = $_GET['sale_id'];
$sql = "SELECT sale.sale_id, sale.sale_date, sale.Net_price, sale.net_discount, product.pro_name, sale_detail.amount, sale_detail.sale_price FROM sale INNER JOIN sale_detail ON sale.sale_id = sale_detail.sale_id INNER JOIN product ON sale_detail.Pro_id = product.Pro_id WHERE sale.sale_id = '$sale_id';";
$sql_detail = "SELECT sale.sale_id, sale.Net_price, product.pro_name, sale_detail.amount, sale_detail.sale_price FROM sale INNER JOIN sale_detail ON sale.sale_id = sale_detail.sale_id INNER JOIN product ON sale_detail.Pro_id = product.Pro_id WHERE sale.sale_id = '$sale_id';";
if($result=$con->query($sql)){
    $row=mysqli_fetch_array($result);    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <?php include_once "../import/css.php"; ?>
    <style>
        .receipt {
            border: 1px solid #000;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 10px;
        }

        .receipt-items {
            margin-top: 10px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
    </style>
</head>

<?php include_once "../import/navbar.php" ?>

<body>
    <div class="receipt my-5">
        <div class="receipt-header">
            <h1>TATC SHOP</h1>
            <p>ขอบคุณที่ซื้อสินค้าเรา!</p>
            <p>
                <?php echo $sale_id?><br>
                <?php echo $row['sale_date']?>
            </p>
        </div>
        <hr>
        <div class="receipt-items">
            <div class="row">
                <div class="col-sm-4">
                    <h6>NAME</h6>
                </div>
                <div class="col-sm-4 text-center">
                    <h6>QTY</h6>
                </div>
                <div class="col-sm-4 text-end">
                    <h6>PRICE</h6>
                </div>
            </div>
            <?php if ($result_detail = $con->query($sql_detail)) {
                while ($row_detail = mysqli_fetch_array($result_detail)) {
            ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <span><?php echo $row_detail['pro_name'] ?></span>
                        </div>
                        <div class="col-sm-4 text-center">
                            <span><?php echo number_format($row_detail['amount']) ?></span>
                        </div>
                        <div class="col-sm-4 text-end">
                            <span>฿<?php echo number_format($row_detail['sale_price'], 2) ?></span>
                        </div>
                    </div>
            <?php
                }
            } ?>
            <!-- Add more items as needed -->
        </div>
        <hr>
        <div class="total d-flex justify-content-between">
            <strong>Total:</strong>
            <?php echo '฿'.number_format($row['Net_price'],2);?>
        </div>
        <div class="discount d-flex justify-content-between">
            <strong>Discount:</strong>
            <?php echo '฿'.number_format($row['net_discount'],2);?>
        </div>
        <div class="net_total d-flex justify-content-between">
            <strong>Net Total:</strong>
            <?php $net_total = $row['Net_price']-$row['net_discount']; echo '฿'.number_format($net_total,2)?>
        </div>
        <hr>
        <div class="contact-info text-center">
            <p>หากมีข้อส่งสัย โปรดติดต่อ<br>โทรศัพท์ 038-238398,038-238527</p>
        </div>
    </div>
    <div class="w-100 d-flex">
        <a href="sale.php" class="btn btn-primary" style="margin: 0 auto;">เริ่มการขายใหม่</a>
    </div>
</body>

</html>