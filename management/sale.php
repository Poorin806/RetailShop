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
        <div class="title mb-3">
            <div class="text">
                <h1>
                    <h class="text-primary">ขายสินค้า</h>
                </h1>
                <h6>Sale</h6>
            </div>
        </div>

        <form action="" method="post">
            <div class="row d-flex align-items-end">
                <div class="col-sm-2">
                    <label for="" class="form-label">วันที่</label>
                    <input type="date" name="" class="form-control" id="date" value="" readonly>
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">รหัสการขาย</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-sm-2">
                    <label for="" class="form-label">รหัสลูกค้า</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-sm-1">
                    <input type="submit" value="ค้นหาลูกค้า" class="btn btn-outline-primary">
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" name="" id="" class="form-control" readonly>
                </div>
                <div class="col-sm-1">
                    <input type="submit" value="เริ่มการขาย" class="btn btn-primary">
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <div class="row d-flex align-items-end">
                <div class="col-sm">
                    <label for="" class="form-label">รหัสสินค้า</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-sm">
                    <label for="" class="form-label">ชื่อสินค้า</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-sm">
                    <label for="" class="form-label">จำนวน</label>
                    <input type="number" name="" id="" class="form-control">
                </div>
            </div>
        </div>

        </form>
    <script>
        document.getElementById('date').valueAsDate = new Date();
    </script>
    <?php include_once "../import/js.php"; ?>
</body>

</html>