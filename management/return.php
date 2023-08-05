<?php include './connect.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คืนสินค้า</title>
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- navbar -->
    <?php include_once "../import/navbar.php" ?>
    <div class="container my-5">
        <div class="title mb-5">
            <div class="text">
                <h1>
                    <h class="fw-bolder text-primary">คืนสินค้า</h>
                </h1>
                <h6>Return</h6>
            </div>
        </div>

        <form id="formReturn" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="title text-secondary">
                <h4><i class="bi bi-1-circle-fill text-primary"></i> กรอกรหัสการขาย</h4>
            </div>
            <div class="row d-flex align-items-end mb-3">
                <div class="col-sm-2">
                    <label for="" class="form-label">รหัสการขาย</label>
                    <input type="text" name="sale_id" id="sale_id" class="form-control" value="">
                    <input type="hidden" name="sale_id_hidden" id="sale_id_hidden" class="form-control">
                </div>
                <div class="col-sm-1">
                    <label for="" class="form-label"></label>
                    <!-- <input type="submit" value="ค้นหา" name="search" class="btn btn-primary"> -->
                    <button type="button" class="btn btn-primary" id="search_sale_id" onclick="getSaleData()">ค้นหา</button>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">วันที่</label>
                    <input type="text" name="sale_date" class="form-control" id="sale_date" value="" disabled>
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">รหัสลูกค้า</label>
                    <input type="text" name="" id="cust_id" class="form-control" disabled>
                </div>
                <div class="col-sm-4">
                    <label for="" class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" name="" id="cust_name" class="form-control" disabled>
                </div>
            </div>

            <div class="title text-secondary">
                <h4><i class="bi bi-2-circle-fill text-primary"></i> เลือกสินค้าที่ต้องการคืน</h4>
            </div>
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th class="text-primary">รหัสสินค้า</th>
                        <th class="text-primary">ชื่อสินค้า</th>
                        <th class="text-primary">จำนวน</th>
                        <th class="text-primary">ราคาต่อหน่วย</th>
                        <th class="text-primary">ลดราคา</th>
                        <th class="text-primary">ราคารวม</th>
                        <th class="text-primary" style="width:10%;">จำนวนการคืน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- Fetch_data_return.js -->
                    </tr>
                </tbody>
            </table>

            <div class="title text-secondary">
                <h4><i class="bi bi-3-circle-fill text-primary"></i> ยืนยันการคืน</h4>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="" class="form-label">เหตุผลในการคืน</label>
                    <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="row-mb-3">
                <h6 class="text-danger">เมื่อยืนยันการคืน รายการสินค้าที่คืนจะถูกเพิ่มจำนวนคืนในสต็อก และข้อมูลการขายในรหัสกายขายนี้จะถูกบันทึกการเปลี่ยนแปลง</h6>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <button type="button" id="btnConfirmReturn" name="confirmReturn" value="ยืนยันการคืน" class="btn btn-primary w-100" disabled>ยืนยันการคืน</button>
                </div>
                <div class="col-sm-3">
                    <input type="submit" id="btnCancelSale" name="cancelSale" value="ยกเลิก" onclick="return confirm('ต้องการยกเลิกรายการขายนี้หรือไม่?')" class="btn btn-outline-danger w-100" disabled>
                </div>
            </div>
        </form>
    </div>
    <script src="js/get_sale_data.js"></script>
    <script src="js/fetch_data_return.js"></script>
    <!-- <script src="js/update_pro_amount.js"></script> -->
    <?php include_once "../import/js.php"; ?>
</body>

</html>