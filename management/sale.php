<?php include './connect.php' ?>
<?php
$today = date("Y-m-d H:i:s");

$sql_latestSaleId = "select max(Sale_id) as sale_id from sale;";
$result_latestSaleId = $con->query($sql_latestSaleId);
$row_lastestSaleId = mysqli_fetch_array($result_latestSaleId);
$latest_saleId = $row_lastestSaleId['sale_id'];
if ($latest_saleId == null) {
    $latest_saleId = 'ไม่มีรหัสการขายก่อนหน้า';
}
else {
    $new_sale_id = preg_replace('/\D/', '', $latest_saleId) + 1;
    $latest_saleId_AutoGenerate = "SA" . $new_sale_id; 
}

if (isset($_POST['confirmSale'])) {
    $sale_id = $_POST['sale_id_hidden'];
    $net_price = $_POST['net_price_hidden'];
    $net_discount = $_POST['net_discount_hidden'];
    $sale_status = 0;
    echo $sql = "UPDATE sale
            SET
            net_price = '$net_price',
            net_discount = '$net_discount',
            sale_status = '$sale_status'
            WHERE sale_id = '$sale_id';
            ";
    $result = $con->query($sql);
    if ($result) {
        echo "<script>alert('ไปยังหน้าพิมพ์ใบเสร็จ')</script>";
    } else {
        echo "<script>alert('ยืนยันการขายไม่สำเร็จ'" . $sql . "')</script>";
    }
}
if (isset($_POST['cancelSale'])) {
    $sale_id = $_POST['sale_id_hidden'];

    $sql_1 = "DELETE FROM sale_detail WHERE sale_id = '$sale_id'";
    $result1 = $con->query($sql_1);

    $sql_2 = "DELETE FROM sale WHERE sale_id = '$sale_id'";
    $result2 = $con->query($sql_2);

    if ($result1 && $result2) {
        // echo "<script>alert('ยกเลิกรายการสำเร็จ')</script>";
        // When refresh, will delete sale, sale_detail automatically
        echo "<script>window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('ยกเลิกรายการไม่สำเร็จ')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ขายสินค้า</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>
    <div class="container my-5">
        <div class="title mb-5">
            <div class="text">
                <h1>
                    <h class="fw-bolder text-primary">ขายสินค้า</h>
                </h1>
                <h6>Sale</h6>
            </div>
        </div>

        <form id="saleForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="title text-secondary">
                <h4><i class="bi bi-1-circle-fill text-primary"></i> ข้อมูลการขาย</h4>
            </div>
            <div class="row d-flex align-items-end mb-3">
                <div class="text-primary mb-3">
                    รหัสการขายก่อนหน้า : <?php echo $latest_saleId; ?>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">วันที่</label>
                    <input type="text" name="sale_date" class="form-control" id="sale_date" value="<?php echo $today ?>" disabled>
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">รหัสการขาย</label>
                    <input type="text" name="sale_id" id="sale_id" class="form-control bg-body-secondary" value="<?php echo $latest_saleId_AutoGenerate ?>" readonly>
                    <input type="hidden" name="sale_id_hidden" id="sale_id_hidden" class="form-control">
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">รหัสลูกค้า</label>
                    <input type="text" name="" id="cust_id" class="form-control" list="cust_id_list">
                    <datalist id="cust_id_list">
                        <?php
                        $sql = "SELECT * FROM customer";
                        $result = $con->query($sql);
                        while ($data = mysqli_fetch_array($result)) {
                            echo "<option value='" . $data['Cust_id'] . "'>";
                        }
                        ?>
                    </datalist>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" name="" id="cust_name" class="form-control" disabled>
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label"></label>
                    <!-- <input type="submit" value="เริ่มการขาย" onclick="createSaleId()" class="btn btn-primary"> -->
                    <button type="button" class="btn btn-primary" id="create_saleId" onclick="createSaleId()">เริ่มการขาย</button>
                </div>
            </div>
            <div class="title text-secondary">
                <h4><i class="bi bi-2-circle-fill text-primary"></i> รายการสินค้า</h4>
            </div>
            <div class="row d-flex align-items-end">
                <div class="col-sm-2">
                    <label for="" class="form-label">รหัสสินค้า</label>
                    <input type="text" name="" id="pro_id" class="form-control" list="pro_id_list">
                    <datalist id="pro_id_list">
                        <?php
                        $sql = "SELECT * FROM product";
                        $result = $con->query($sql);
                        while ($data = mysqli_fetch_array($result)) {
                            echo "<option value='" . $data['Pro_id'] . "'>";
                        }
                        ?>
                    </datalist>
                </div>
                <div class="col-sm">
                    <label for="" class="form-label">ชื่อสินค้า</label>
                    <input type="text" name="" id="pro_name" class="form-control" disabled>
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">ราคา (ต่อหน่วย) บาท</label>
                    <input type="text" name="" id="pro_saleprice" class="form-control" disabled>
                </div>
                <div class="col-sm-1">
                    <label for="" class="form-label">จำนวน</label>
                    <input type="number" name="" id="pro_amount" class="form-control">
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">ราคา (รวม) บาท</label>
                    <input type="text" name="" id="total_per_pro" class="form-control" disabled>
                </div>
                <div class="col-sm-1">
                    <label for="" class="form-label">ส่วนลด บาท</label>
                    <input type="number" name="" id="discount" class="form-control">
                </div>
                <div class="col-sm-1">
                    <label for="" class="form-label"></label>
                    <!-- <input type="submit" name="" id="btn_addProduct" class="form-control btn btn-secondary disabled" value="เพิ่มสินค้า" onclick="add_product()"> -->
                    <button type="button" id="btn_addProduct" class="btn btn-secondary disabled" onclick="addProduct()">เพิ่มสินค้า</button>
                </div>
            </div>

            <div class="my-3">
                <?php include 'js/fetch_table.php' ?>
            </div>
            <div class="title text-secondary">
                <h4><i class="bi bi-3-circle-fill text-primary"></i> สรุปราคา</h4>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label for="" class="form-label">ราคารวม บาท</label>
                    <input type="text" name="" id="total_price" class="form-control" disabled>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ส่วนลด บาท</label>
                    <input type="number" name="" id="net_discount" class="form-control" disabled>
                    <input type="hidden" name="net_discount_hidden" id="net_discount_hidden" class="form-control">
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ราคาสุทธิ บาท</label>
                    <input type="text" name="" id="net_price" class="form-control" disabled>
                    <input type="hidden" name="net_price_hidden" id="net_price_hidden" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label for="" class="form-label">รับเงิน บาท</label>
                    <input type="text" name="" id="receive_price" class="form-control" disabled>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">เงินทอน บาท</label>
                    <input type="text" name="" id="change_price" class="form-control" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <!-- <input type="submit" id="btnConfirmSale" name="confirmSale" value="ยืนยันการขาย" class="btn btn-primary w-100" disabled> -->
                    <button type="button" id="btnConfirmSale" onclick="" class="btn btn-primary w-100" disabled>ยืนยันการขาย</button>
                </div>
                <div class="col-sm-3">
                    <input type="submit" id="btnCancelSale" name="cancelSale" value="ยกเลิก" onclick="return confirm('ต้องการยกเลิกรายการขายนี้หรือไม่?')" class="btn btn-danger w-100" disabled>
                </div>
            </div>
        </form>
    </div>

    <script>
        // document.getElementById('sale_date').valueAsDate = new Date();
    </script>

    <!-- Search Customer by ID and return FullName -->
    <script src="js/search_customer.js"></script>
    <script src="js/search_product.js"></script>
    <script src="js/calPricePerAmount.js"></script>
    <script src="js/create_saleId.js"></script>
    <script src="js/add_product.js"></script>
    <script src="js/delete_product.js"></script>
    <script src="js/fetch_data.js"></script>
    <script src="js/calChange.js"></script>
    <script src="js/delete_sale.js"></script>
    <script src="js/confirm_sale.js"></script>
    <?php include_once "../import/js.php"; ?>

</body>

</html>