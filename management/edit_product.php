<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลสินค้า</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>
    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>แก้ไขข้อมูล<h class="text-primary">สินค้า</h></h1>
                <h6>Edit Product Data</h6>
            </div>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <label for="" class="form-label">รหัสสินค้า</label>
                    <input type="text" name="" id="" class="form-control" placeholder="" disabled>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">ชื่อสินค้า</label>
                    <input type="text" name="" id="" class="form-control" placeholder="">
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ราคา (ต้นทุน)</label>
                    <input type="number" name="" id="" class="form-control" placeholder="">
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ราคา (ขาย)</label>
                    <input type="number" name="" id="" class="form-control" placeholder="">
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ราคา (สมาชิก)</label>
                    <input type="number" name="" id="" class="form-control" placeholder="">
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">จำนวน</label>
                    <input type="number" name="" id="" class="form-control" placeholder="">
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ประเภทสินค้า</label>
                    <select name="" id="" class="form-select">
                        <option value="">เลือกประเภทสินค้า...</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ชั้นวาง</label>
                    <select name="" id="" class="form-select">
                        <option value="">เลือกชั้นวาง...</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">ตัวแทนจำหน่าย</label>
                    <select name="" id="" class="form-select">
                        <option value="">เลือกตัวแทนจำหน่าย...</option>
                    </select>
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="" class="form-label">จุดที่ขาย</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <input type="submit" value="ยกเลิก" class="btn btn-secondary" name="cancel">
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>